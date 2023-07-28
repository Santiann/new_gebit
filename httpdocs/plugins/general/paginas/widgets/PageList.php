<?php namespace General\Paginas\Widgets;

use Str;
use Lang;
use Input;
use Backend\Classes\WidgetBase;
use Cms\Classes\Theme;
use Cms\Classes\Page;
use Backend\Classes\Controller;
use General\Paginas\Classes\PageListHelper;


/**
 * Static page list widget.
 *
 * @package General\Paginas
 * @author Alexey Bobkov, Samuel Georges
 */
class PageList extends WidgetBase
{
    use \Backend\Traits\SearchableWidget;
    use \Backend\Traits\CollapsableWidget;
    use \Backend\Traits\SelectableWidget;

    public $theme;
    
    protected $helper;

    public $noRecordsMessage = 'general.paginas::lang.page.no_records';

    /**
     * Constructor para propriedades customizadas
     * @param Controller $controller
     * @param string $alias
     */
    public function __construct($controller, $alias)
    {
        $this->alias = $alias;
        $this->theme = Theme::getEditTheme();
        $this->helper = new PageListHelper($this);

        parent::__construct($controller, []);
        $this->bindToController();
    }

    /**
     * Carrega os assets dentro da página
     * {@inheritDoc}
     * @see \Backend\Classes\WidgetBase::loadAssets()
     */
    public function loadAssets()
    {
        parent::loadAssets();
        $this->addCss('css/pagelist.css');
        $this->addJs('js/pagelist.js');
    }

    /**
     * Renders the widget.
     * @return string
     */
    public function render()
    {
        return $this->makePartial('body', [
            'data'          => $this->helper->getData(),
            'currentUrlId'  => $this->helper->getCurrentUrlId()
        ]);
    }

    /**
     * Returns information about this widget, including name and description.
     */
    public function widgetDetails() {}


    // BUSCA    
    
    public function onSearch()
    {
        $this->setSearchTerm(Input::get('search'));
        $this->extendSelection();

        return $this->updateList();
    }
    
    public function setSearchTerm($term)
    {
        $this->searchTerm = trim($term);
        \Session::put('searchPageMenu', $this->searchTerm);
    }
    
    public function getSearchTerm()
    {
        return $this->searchTerm !== false ? $this->searchTerm : \Session::get('searchPageMenu');
    }

    // COLAPSABILIDADE
    
    public function onGroupStatusUpdate()
    {
        $painel = Input::get('object');
        foreach($painel as $group => $staus)
        {
            $this->setGroupStatus($group, $staus);
        }
    }
    
    public function setGroupStatus($group, $status = false)
    {
        $statuses = $this->getGroupStatuses();
        $statuses[$group] = $status;
        $this->groupStatusCache = $statuses;
        \Session::put('pageListCollapsable', $statuses);
    }
    
    public function getGroupStatuses()
    {
        if ($this->groupStatusCache !== false) {
            return $this->groupStatusCache;
        }

        $groups = \Session::get('pageListCollapsable',[]);
        if (!is_array($groups)) {
            return $this->groupStatusCache = [];
        }

        return $this->groupStatusCache = $groups;
    }

    

    public function getGroupStatus($group)
    {       
        $statuses = $this->getGroupStatuses();
        if (array_key_exists($group, (array)$statuses)) {
            return $statuses[$group];
        }
        
        return false;
    }
    
    /**
     * Atualiza a parte central da lista
     * @return array
     */
    public function updateList()
    {
        //@fixme , por algum motivo obscuro a busca faz os itens caminharem um nivel para dentro.
        $data = $this->helper->getData();
        $data = $this->helper->fixMisplace($data);
    
        return ['#'.$this->getId('page-list') => $this->makePartial('items', [
            'items'         => $data,
            'currentUrlId'  => $this->helper->getCurrentUrlId()
        ])];
    }
    
    
    // SESSÃO
    
    /**
     * Sobreescreve o método padrão para recuperar a sessão da busca
     * {@inheritDoc}
     * @see \Backend\Classes\WidgetBase::getSession()
     */
    public function getSession($key = null, $default = null)
    {
        $key = strlen($key) ? $this->helper->getThemeSessionKey($key) : $key;
    
        return parent::getSession($key, $default);
    }
    
    /**
     * Sobreescreve o método padrão para gravar a sessão da busca
     * {@inheritDoc}
     * @see \Backend\Classes\WidgetBase::putSession()
     */
    public function putSession($key, $value)
    {
        return parent::putSession($this->helper->getThemeSessionKey($key), $value);
    }
}
