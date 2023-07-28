<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 25/11/15
 * Time: 09:48
 */

namespace General\General\Classes\Traits;


trait Copy
{

    public function update_onCopy($id)
    {
        return $this->create_onSave($id);
    }
}