<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_site extends Model
{
    protected $connection = "mysql_site";

    protected $table = 'users';
}
