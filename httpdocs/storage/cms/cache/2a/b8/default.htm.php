<?php 
class Cms64c09b1800942879186847_da855b10e3264076873145c95435183dClass extends Cms\Classes\LayoutCode
{
public function onEnd() {
    if($this['activeLocale'] == 'pt-br')
        $this['dateFormat'] = 'Y-M-d';
    else
        $this['dateFormat'] = 'd/M/Y';
}
}
