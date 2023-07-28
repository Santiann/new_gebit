<?php namespace General\General\Classes\CombinedSearch;


use \DB;

/**
 * Classe para realiza��o de buscas utilizando models do eloquent
 * Class EloquentCombinedSearch
 * @package General\General\Classes\CombinedSearch
 * @author H�lio Figueira Junior
 */
class EloquentCombinedSearch
{
    private $stopwords = [
        'de','a','o','que','e','do','da','em','um','para','�','com','n�o','uma','os','no','se','na','por','mais','as','dos',
        'como','mas','foi','ao','ele','das','tem','�','seu','sua','ou','ser','quando','muito','h�','nos','j�','est�','eu',
        'tamb�m','s�','pelo','pela','at�','isso','ela','entre','era','depois','sem','mesmo','aos','ter','seus','quem','nas',
        'me','esse','eles','est�o','voc�','tinha','foram','essa','num','nem','suas','meu','�s','minha','t�m','numa','pelos',
        'elas','havia','seja','qual','ser�','n�s','tenho','lhe','deles','essas','esses','pelas','este','fosse','dele','tu',
        'te','voc�s','vos','lhes','meus','minhas','teu','tua','teus','tuas','nosso','nossa','nossos','nossas','dela','delas',
        'esta','estes','estas','aquele','aquela','aqueles','aquelas','isto','aquilo','estou','est�','estamos','est�o','estive',
        'esteve','estivemos','estiveram','estava','est�vamos','estavam','estivera','estiv�ramos','esteja','estejamos','estejam',
        'estivesse','estiv�ssemos','estivessem','estiver','estivermos','estiverem','hei','h�','havemos','h�o','houve','houvemos',
        'houveram','houvera','houv�ramos','haja','hajamos','hajam','houvesse','houv�ssemos','houvessem','houver','houvermos',
        'houverem','houverei','houver�','houveremos','houver�o','houveria','houver�amos','houveriam','sou','somos','s�o','era',
        '�ramos','eram','fui','foi','fomos','foram','fora','f�ramos','seja','sejamos','sejam','fosse','f�ssemos','fossem','for',
        'formos','forem','serei','ser�','seremos','ser�o','seria','ser�amos','seriam','tenho','tem','temos','t�m','tinha','t�nhamos',
        'tinham','tive','teve','tivemos','tiveram','tivera','tiv�ramos','tenha','tenhamos','tenham','tivesse','tiv�ssemos','tivessem',
        'tiver','tivermos','tiverem','terei','ter�','teremos','ter�o','teria','ter�amos','teriam'
    ];

    private $searchTerm = [];

    private $modelsConfig;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Fun��o construtora para determinar os parametros da busca
     * @param int $pageSize Tamanho da P�gina
     * @param int $currentPage P�gina Atual
     */
    public function __construct($pageSize = 1, $currentPage = 1)
    {
        $this->pageSize         = $pageSize;
        $this->currentPage      = $currentPage;
        $this->offset           = $this->pageSize*($this->currentPage - 1);
    }

    /**
     * Adiciona as models para a busca
     * @param $model
     * @param $aliases
     * @param $fieldsToSearch
     */
    public function addModel($name,$model,$aliases,$fieldsToSearch)
    {
        $this->modelsConfig[] = [
            'name'              => $name,
            'builder'           => $model,
            'aliases'           => $aliases,
            'fieldsToSearch'    => $fieldsToSearch
        ];
    }

    /**
     * Fun��o para prepara o texto de entrada para a busca
     * @param string $searchText Texto para a prepara��o
     * @return mixed
     */
    public function prepare($searchText = '')
    {
        $kwords = [];
        $acentos = array(
            "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
            "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", '�', '�'
        );

        $sem = array(
            '%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%',
            '%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%','%'
        );

        $searchArray = explode(' ', urldecode($searchText));
        foreach ($searchArray as $eachWord)
        {
            if( !in_array($eachWord, $this->stopwords) )
            {
                $resto = '/[^a-z0-9\%]+/i';
                $eachWord = str_replace($acentos, $sem, $eachWord);
                $eachWord = preg_replace($resto, '', $eachWord);
                $kwords[] = trim($eachWord);
            }
        }

        return $kwords;
    }

    /**
     * Adiciona os termos de busca dentro da model
     * @param $stringToSeach
     */
    public function setSearchTerm($stringToSeach)
    {
        $this->searchTerm = $this->prepare($stringToSeach);
    }

    /**
     * @return mixed
     */
    public function genereteResult()
    {
        $firstConfig    = array_shift($this->modelsConfig);

        $model          = new $firstConfig['builder']();    //instancia a model
        $aliases        = $this->parseAlias($firstConfig); //processa os alias
        $queryBuilder   = $this->parseBuilder($model, $aliases, $firstConfig); // processa os builders

        foreach($this->modelsConfig as $config)
        {
            $model                  = new $config['builder'](); // instancia a model
            $aliases                = $this->parseAlias($config); // processa os aliases
            $queryBuilderSubquery   = $this->parseBuilder($model, $aliases, $config); // processa as subquerys

            $queryBuilder           = $queryBuilder->union($queryBuilderSubquery);
        }

        return  $queryBuilder->limit($this->pageSize)->offset($this->offset)->get();
    }

    public function parseBuilder($model, $aliases, $config)
    {
        $builder = DB::table($model->table)->select($aliases);
        foreach($config['fieldsToSearch'] as $fields){
            foreach( $this->searchTerm as $item)
            {
                $builder->having($fields,' like ', '%'.$item.'%');
            }
        }

        return $builder;
    }

    /**
     *
     * @param $arrayAliases
     * @return array
     */
    public function parseAlias($config)
    {
        $default = [];
        foreach($config['aliases'] as $field => $alias)
        {
            $default[] = $field.' AS '.$alias;
        }

        $default[] = DB::raw('\''.$config['name'].'\' AS \'type\'');
        return $default;
    }


    /**
     * Retorna o resutlado da consulta
     * @return array
     */
    public function getResult()
    {
        $result = $this->genereteResult();
        return $result;
    }

}