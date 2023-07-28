<?php 
class Cms64c176cecf1ce920706924_088f9506d32f2bb24a159aa5a1b49080Class extends Cms\Classes\LayoutCode
{
public function onEnd() {
    if($this['activeLocale'] == 'pt-br')
        $this['dateFormat'] = 'Y-M-d';
    else
        $this['dateFormat'] = 'd/M/Y';
}
}
