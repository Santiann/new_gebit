<?php namespace General\Translate\Updates;

use October\Rain\Database\Updates\Seeder;
use General\Translate\Models\Locale;

class SeedAllTables extends Seeder
{

    public function run()
    {
        Locale::create(['code' => 'en', 'name' => 'English', 'is_default' => true, 'is_enabled' => true]);
    }

}
