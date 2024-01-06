<?php 
class Cms658378635953c486016275_b5327d3c1e073760e5990f5e62349ce3Class extends Cms\Classes\LayoutCode
{
public function onEnd() {
    if($this['activeLocale'] == 'pt-br')
        $this['dateFormat'] = 'Y-M-d';
    else
        $this['dateFormat'] = 'd/M/Y';
}
}
