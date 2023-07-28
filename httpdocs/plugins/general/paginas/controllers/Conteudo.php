<?php namespace General\Paginas\Controllers;

use General\Paginas\Classes\FormWidgetBuilder;
use General\Paginas\Classes\LocaleSupport\TranslatorDriver;
use General\Paginas\Classes\PageSubController;
use General\Paginas\Models\Pagina;
use Backend\Facades\BackendMenu;
use Backend\Widgets\Form;
use Cms\Classes\Theme;
use General\Paginas\Widgets\PageList;
use \General\Paginas\Classes\Page;
use Illuminate\Support\Facades\Request;
use General\Paginas\Models\Conteudo as ModelConteudo;
use General\Paginas\Models\Pagina as ModelPagina;
use System\Models\PluginVersion;

/**
 * Classe báisca para a edição do contuedo editável das páginas
 *
 * Class Conteudo
 * @package General\Paginas\Controllers
 */
class Conteudo extends PageSubController
{
    /** @var  Form */
    protected $widgetForm;

    /** @var  Page */
    protected $page;

    /** @var array  */
    public $requiredPermissions = ['general.paginas.*'];

    /**
     * Method only for displaying the welcome page
     */
    public function index()
    {
        BackendMenu::setContext('General.Paginas', 'pages');

        $this->pageTitle = 'Edição de Páginas ';

        $this->prepareVars();
    }

    public function carregar($firstLevel = null, $secondLevel = null, $thirdLevel = null)
    {
        $this->prepareVars();
        $page = $this->page->loadPage($firstLevel,$secondLevel,$thirdLevel);

        $widget = $this->makeObjectFormWidget($this->page);
        $widget->bindToController();

        $this->pageTitle = 'Editando '.$page->title;

        $this->vars['page'] = $this->page->getCmsPage();
        $this->vars['formWidget'] = $this->widgetForm = $widget;
    }

    public function onSave($firstLevel = null, $secondLevel = null, $thirdLevel = null){

        $settings    = \Request::input('settings',[]);

        $this->prepareVars();

        $this->page->loadPage($firstLevel, $secondLevel, $thirdLevel);
        $this->page->updateSettings($settings);
        $this->page->releaseContent();

        $widget = $this->makeObjectFormWidget($this->page);
        $widget->bindToController();

        $values = $widget->getSaveData();
        $content = array_get($values, FormWidgetBuilder::fistLevelPage);

        $this->page->getCmsPage();

        ModelConteudo::updatePage($content, $this->page);
        ModelPagina::updatePage($this->page);

        /** todo Create interfaces for diferent saves and recoveries */
        if(PluginVersion::where('code','General.Translate')->applyEnabled()->exists()){
            $translator = new TranslatorDriver($this->page);
            $translator->updateTranslations($this->page, $content);
        }

        \Flash::success(\Lang::get('general.paginas::lang.page.saved'));
    }

    protected function prepareVars()
    {
        $this->widgetMenu = new PageList($this, 'pageList');
        $this->theme = Theme::getEditTheme();
        $this->page = new Page([],$this->theme);
    }

    protected function makeObjectFormWidget($pageObject)
    {
        $alias = \Request::input('formWidgetAlias');
        $builder = new FormWidgetBuilder($pageObject, $this, $alias);
        return $builder->getWidget();
    }

}