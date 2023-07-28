<?php namespace General\Paginas\Classes;

use General\Paginas\Widgets\PageList;
use General\Paginas\Classes\PageList as StaticPageList;

/**
 * Registra funções para facilitar tarefas paralelas ao fluxo
 * principal da classe PageList.
 * @author Hélio <helio@general.com.br>
 * @package General/Paginas
 */
class PageListHelper
{
    protected $widget;
    
    public function __construct(PageList $widget)
    {
        $this->widget = $widget;
        $this->theme = $this->widget->theme;
    }
    
    public function getCurrentUrlId()
    {
        $backendUrl = \Config::get('cms.backendUri', 'backend');
    
        $currentArray   = explode('/', \Request::url());
        $offset         = array_search($backendUrl, $currentArray);
    
        $pluginInfo[]  = array_get($currentArray,$offset+1);
        $pluginInfo[]  = array_get($currentArray,$offset+2);
        $pluginInfo[]  = array_get($currentArray,$offset+3,'index');
    
        return implode('.', $pluginInfo);
    }
    
    public function getThemeSessionKey($prefix)
    {
        return $prefix.$this->theme->getDirName();
    }
    
    public function getData()
    {
        $pageList   = new StaticPageList($this->theme);
        $pages      = $pageList->getPageTree(true);
    
        $searchTerm = \Str::lower($this->widget->getSearchTerm());
        if (strlen($searchTerm)) {
            $words = explode(' ', $searchTerm);
    
            $iterator = function($pages) use (&$iterator, $words) {
                $result = [];
    
                foreach ($pages as $index => $page) {
    
                    if ($this->textMatchesSearch($words, $this->subtreeToText($page))) {
    
                        $result[] = (object) [
                            'page'      => $page,
                            'subpages'  => $iterator($page->subpages),
                            'modules'   => $page->modules
                        ];
                    }
                }
    
                return $result;
            };
    
            $pages = $iterator($pages);
        }
    
        return $this->fixMisplace($pages);
    }
    
    public function fixMisplace($data){
    
        if(isset($data[0]->page->page)){
            foreach($data as $index => $itens){
                $data[$index] = $data[$index]->page;
            }
        }
        return $data;
    }
    
    protected function subtreeToText($page)
    {
        $result = $this->pageToText($page->page).' '.$this->moduleToText($page->modules);
    
        $iterator = function($pages) use (&$iterator, &$result) {
            foreach ($pages as $page) {
                $result .= ' '.$this->pageToText($page->page);
                $iterator($page->subpages);
            }
        };
    
        $iterator($page->subpages);
    
        return $result;
    }
    
    protected function moduleToText($modules){
        $search = '';
    
        foreach($modules as $moduleIdentifier => $moduleConfig){
            $search .= array_get($moduleConfig , 'title').' '.array_get($moduleConfig , 'description');
        }
    
        return $search;
    }
    
    protected function pageToText($page)
    {
        return array_get($page->settings ,'title').' '.array_get($page->settings ,'url');
    }
    
    protected function textMatchesSearch(&$words, $text)
    {
        foreach ($words as $word) {
            $word = trim($word);
            if (!strlen($word)) {
                continue;
            }
    
            if (\Str::contains(\Str::lower($text), $word)) {
                return true;
            }
        }
    
        return false;
    }
}
