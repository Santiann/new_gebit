<?php namespace General\Paginas\Components;

use General\General\Classes\VideoParser\VideoDriver;
use Cms\Classes\ComponentBase;

/**
 * Classe de controle do componente
 * Class Conteudo
 * @package General\Paginas\Components
 */
class Conteudo extends ComponentBase
{

    /**
     * Array de campos recuperados do banco.
     * @var
     */
    private $fields;


    ///////////////////////////////////////////////////// METHOD ///////////////////////////////////////////////////////

    /**
     * Método executado ao carregar a p�gina com o plugin
     * @throws \Exception
     */
    public function onRun(){

        $page           = strtolower($this->property('page'));
        $pageWithFields = \General\Paginas\Models\Pagina::findByIdentifier($page);
        $this->hydratateValueProp($pageWithFields);
    }

    /**
     * Método de defini��o dos detalhes do componentes
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'general.paginas::lang.components.conteudo.name',
            'description' => 'general.paginas::lang.components.conteudo.description'
        ];
    }

    /**
     * Defini��o de quais campos s�o configuraveis
     * @return array Configura��es
     */
    public function defineProperties()
    {
        return [
            'page' => [
                'title'       => 'general.paginas::lang.components.conteudo.params.page.name',
                'description' => 'general.paginas::lang.components.conteudo.params.page.description',
                'type'        => 'string',
            ]
        ];
    }

    /**
     * Popula o array de dados da
     * @param $page
     */
    private function hydratateValueProp($page)
    {
        $fieldsFromPage = $page->conteudo;
        foreach($fieldsFromPage as $field)
        {
            $this->fields[$field->identifier] = $field->valor;
        }

        $this->fields['seo_description']    = $page->seo_description;
        $this->fields['seo_title']          = $page->seo_title;
    }

    /**
     * Método para recuperar o valor  deu campo, ou retorna default
     * @param $field    nome do parametro buscado
     * @default $field Valor padr�o para retorno
     * @return string Valor do campo
     * @throws \Exception
     */
    public function getField($field, $default = '')
    {
        if(isset($this->fields[$field]))
        {
            $default = $this->fields[$field];
        }

        return $default;
    }

    public function getArrayItem($field, $order = 0, $default = '')
    {
        $value = $this->getField($field,$default);

        if(is_int($order))
        {
            return isset($value[$order])? $value : $default;

        }else if(is_string($order)&& is_array($value)){

            return array_fetch($value,$order);
        }

        return $value;

    }

    public function getVideo($field, $default = ''){

        $value = $this->getField($field,$default);
        $video = new VideoDriver($value);
        return $video;
    }
}