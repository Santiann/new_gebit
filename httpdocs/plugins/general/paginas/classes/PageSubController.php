<?php namespace General\Paginas\Classes
{
    use Backend\Classes\Controller;
    use Backend\Facades\BackendMenu;
    use Cms\Classes\Theme;
    use General\Paginas\Widgets\PageList;
    use October\Rain\Exception\ApplicationException;

    /**
     * Classe básica para todos os controllers que serão sobmódulos do Páginas
     *
     * Class PageSubController
     * @package General\Paginas\Classes
     */
    class PageSubController extends Controller
    {
        /** @var  Theme Tema atual */
        protected $theme;

        /** @var string template atual */
//        public $layout = 'subpage';

        /** @var  PageList Widget para o menu */
        protected $pageList;

        /**
         * Sobreescrita para a definição do template default para os submodulos do páginas
         * @throws ApplicationException
         */
        public function __construct()
        {
            parent::__construct();

            try
            {
                $this->loadTheme();
                $this->loadWidgets();
//                $this->loadLayout();
                BackendMenu::setContext('General.Paginas', 'pages');

            }
            catch (\Exception $ex) {
                $this->handleError($ex);
            }

        }

        /**
         * Metodo para carregar o template autal dentro de uma var do controller base
         * @throws ApplicationException
         */
        protected function loadTheme()
        {
            if (!($this->theme = Theme::getEditTheme())) {
                throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));
            }
        }

        /**
         * Carrega os widgets que serão utilizados na página
         */
        protected function loadWidgets()
        {
            $this->pagelist = new PageList($this, 'pageList');
        }

        /**
         * Carrega o layout que será usado na página
         */
        protected function loadLayout()
        {
            $this->layoutPath[] = '~/plugins/general/paginas/layouts';
        }
    }
}
