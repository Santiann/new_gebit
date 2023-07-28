<?php namespace General\Paginas\Components{

    use General\Paginas\Models\Conteudo;
    use Cms\Classes\ComponentBase;

    /**
     * The static page component.
     *
     * @package General\Paginas
     * @author Alexey Bobkov, Samuel Georges
     */
    class PageContent extends ComponentBase
    {
        //Attribute

        public $pageIdentifier;

        public $pageContent;

        // Method

        public function componentDetails()
        {
            return [
                'name'        => 'Page Content',
                'description' => 'Recupera o conteudo de uma página qualquer'
            ];
        }

        public function defineProperties()
        {
            return [
                'identifier' => [
                    'title'       => 'Identificado de Página',
                    'description' => 'Especifica a página para ser buscado o conteudo',
                    'type'        => 'dropdown'
                ]
            ];
        }

        public function getIdentifierOptions()
        {
            return Conteudo::getPages()->lists('titulo','pagina');
        }

        public function prepareVars()
        {

            $this->pageIdentifier = $this->property('identifier');;
        }

        public function loadPageContent()
        {
            $content = Conteudo::findPageContent($this->pageIdentifier);
            return $content;
        }

        public function onRun()
        {
            $this->prepareVars();

            $this->pageContent = $this->loadPageContent();
        }

        public function get($position, $default = false)
        {
            return array_get($this->pageContent, $position, $default);
        }

    }
}