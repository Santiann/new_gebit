<?php namespace General\General\Database\Seeds;

use DB;
use Seeder;
use Backend\Models\User;
use Backend\Models\UserGroup;

class SeedSetupAdmin extends Seeder
{
    public function setDefaults($values)
    {
        if (!is_array($values)) {
            return;
        }
        foreach ($values as $attribute => $value) {
            static::$$attribute = $value;
        }
    }

    public function run()
    {
        $this->seedAdmins();
        $this->seedDev();
        $this->seedSettings();
      }

    private function seedAdmins()
    {
        $group_admin = UserGroup::create([
            'name' => 'Administradores',
            'code' => 'admin',
            'description' => '',
            'is_new_user_default' => true
        ]);

        $admin = User::create([
            'email'                 => 'administrador@general.com.br',
            'login'                 => 'admin',
            'password'              => 'admin110',
            'password_confirmation' => 'admin110',
            'first_name'            => 'administrador',
            'last_name'             => '',
            'permissions'           => [],
            'is_activated'          => true
        ]);

        $admin->addGroup($group_admin);
    }

    private function seedDev()
    {
        $group_dev = UserGroup::create([
            'name' => 'Desenvolvedores',
            'code' => 'dev',
            'description' => '',
            'is_new_user_default' => false
        ]);

        $dev = User::create([
            'email'                 => 'desenvolvimento@general.com.br',
            'login'                 => 'dev',
            'password'              => 'dev110',
            'password_confirmation' => 'dev110',
            'first_name'            => 'Desenvolvimento',
            'last_name'             => '',
            'permissions'           => ['superuser' => 1],
            'is_activated'          => true
        ]);

        $dev->addGroup($group_dev);
    }

    private function seedSettings()
    {
        DB::table('system_settings')
            ->insert(['item' => 'backend_brand_settings', 'value' => '{"app_name":"Painel Base","app_tagline":"Painel administraivo","primary_color_light":"#1abc9c","primary_color_dark":"#16a085","secondary_color_light":"#1abc9c","secondary_color_dark":"#16a085","custom_css":"#layout-mainmenu{\r\n    background-color : #107B66 !important;\r\n}\r\n\r\nnav#layout-mainmenu.navbar ul li{\r\n    color : #FFF !important;\r\n}\r\n\r\nnav#layout-mainmenu.navbar ul li.active\r\n{\r\n    color : #FFF !important;\r\n    border-top: 5px solid #16A085;\r\n}\r\n\r\nnav#layout-mainmenu.navbar ul li a, nav#layout-mainmenu .menu-toggle, .mainmenu-collapsed li a{\r\n    padding-top : 9px;\r\n}\r\n\r\n#layout-sidenav ul li a{\r\n    color : rgba(255,255,255,0.55);\r\n}\r\n\r\nform > div.modal-header > button {\r\n    position: relative;\r\n    left: -5px;\r\n}\r\n\r\ndiv.repeater-item-remove > button {\r\n    color: #000000 !important;\r\n    left: 5px;\r\n}\r\n\r\n.flash-message button{\r\n    display : none !important;\r\n}"}']);

    }
}
