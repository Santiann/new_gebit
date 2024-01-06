<?php 
class Cms65837826e08ce321053672_79fbfba21be15d901705d817077ace6cClass extends Cms\Classes\LayoutCode
{
public function onEnd() {
    if($this['activeLocale'] == 'pt-br')
        $this['dateFormat'] = 'Y-M-d';
    else
        $this['dateFormat'] = 'd/M/Y';
}
}
