<?php 
class Cms60cbc4d1da48f495561049_6500b0321c19a6129c256166abe99a52Class extends Cms\Classes\PageCode
{
public function onStart()
{
    if (!$this->param('plan_id')) {
        return \Redirect::to('pricing');
    }
}
}
