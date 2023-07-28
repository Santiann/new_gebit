<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
            RolesTableSeeder::class, ParametroTableSeeder::class
        ]);


        ///TODO: criar a seed da empresa SUPER aDMIN


        /// criando uma seed
        /// php artisan make:seeder UsersTableSeeder
        /// aguardar o console terminar
        /// editar a seed
        ///
        ///
        /// para rodar todas as seed definida
        /// php artisan db:seed
        /// php artisan db:seed --class=ParametroTableSeeder

    }
}
