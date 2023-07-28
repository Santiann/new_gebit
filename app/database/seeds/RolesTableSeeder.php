<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // criando um perfil super admin
        Role::create([
            'name' => 'Super Administrador',
            'display_name'  => 'Super Administrador',
            'description'  => 'Super Administrador',
            'status'  => '1',
            'ind_super_adm'  => '1',
            'ind_adm'  => '0',
            'ind_cliente'=>'0',
            'ind_fornecedor'=>'0',
        ]);

        Role::create([
            'name' => 'Administrador',
            'display_name'  => 'Administrador',
            'description'  => ' Administrador',
            'status'  => '1',
            'ind_super_adm'  => '0',
            'ind_adm'  => '1',
            'ind_cliente'=>'0',
            'ind_fornecedor'=>'0',
        ]);

        Role::create([
            'name' => 'Cliente',
            'display_name'  => 'Cliente',
            'description'  => ' Cliente',
            'status'  => '1',
            'ind_super_adm'  => '0',
            'ind_adm'  => '0',
            'ind_cliente'=>'1',
            'ind_fornecedor'=>'0',
        ]);

        Role::create([
            'name' => 'Administrador',
            'display_name'  => 'Administrador',
            'description'  => ' Administrador',
            'status'  => '1',
            'ind_super_adm'  => '0',
            'ind_adm'  => '0',
            'ind_cliente'=>'0',
            'ind_fornecedor'=>'1',
        ]);
    }
}
