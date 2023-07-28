<?php 
class Cms64c176da15eec681698172_b76ef82da95d7c5fba1ab03f8b71da84Class extends Cms\Classes\LayoutCode
{
public function onEnd() {
    if($this['activeLocale'] == 'pt-br')
        $this['dateFormat'] = 'Y-M-d';
    else
        $this['dateFormat'] = 'd/M/Y';
}
}
