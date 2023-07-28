<?php 
class Cms60d1388d66a9a164175878_b2b29ca18ae244f6af613a0f7f03d9dbClass extends Cms\Classes\PageCode
{
public function onStart()
{
    $component = new \RainLab\User\Components\Session();
    $component->onLogout();
    return Redirect::to('login');
}
}
