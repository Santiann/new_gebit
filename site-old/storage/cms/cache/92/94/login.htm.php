<?php 
class Cms60cbc437216ac071096874_c78dd4c2ebede2b394c31021998da2dfClass extends Cms\Classes\PageCode
{
public function onStart()
{
    if (\Auth::user() && !get('reset')) {
        return \Redirect::to('/');
    }
}
}
