<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use \App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            //$event->menu->add('MAIN NAVIGATION');

            /*
            $event->menu->add([
                'text'        => 'Menus',
                'url'         => 'permissions',
                'icon'        => 'far fa-fw fa-file',
                'label'       => "",
                'label_color' => 'success',
            ]);
            $event->menu->add([
                    'text'        => "teste filho",
                    'url'         => "teste",
                    'icon'        => "",
                    'label'       => "",
                    'label_color' => '',
                    'submenu' => [
                        [
                            'text' => '46',
                            'url' => '#',
                        ],
                        [
                            'text' => '7897',
                            'url' => '#',
                        ],
                    ],
                ]);
            */
            $menus = Permission::query()
                ->join('permission_role','permission_role.permission_id','=','permissions.id')
                ->join('roles', 'roles.id', '=', 'permission_role.role_id')
                ->join('role_user', 'roles.id', '=', 'role_user.role_id')
                ->join('users', 'role_user.user_id', '=', 'users.id')
                ->where('tipo', "MENU")
                ->where('users.id','=', Auth::user()->id??0)
                ->where('permissions.status','=', "1")
                ->where('roles.status','=', "1")
                ->select('permissions.id','permissions.name', 'permissions.display_name', 'permissions.description', 'permissions.tipo', 'permissions.url', 'permissions.idparent', 'permissions.ordem', 'permissions.icone','permissions.status')
                ->distinct()->orderBy('permissions.ordem')
                ->get();


            $menugroup = $menus->groupBy('idparent');



            if(count($menugroup)>0) {
                if(($menugroup[""]??"") != "") {
                    $menugroup[""]->map(function ($row, $value) use ($event, $menugroup) {

                        $subMenu = [];
                        if (($menugroup[$row->id] ?? null)) {
                            ($menugroup[$row->id] ?? null)->map(function ($row, $value) use (&$subMenu,$menugroup) {

                                $this->subMenu($subMenu,$row,$menugroup);

                            });
                        }

                        $collection = collect(
                            [
                                'idRow' => $row->id,
                                'text' => $row->display_name,
                                'url' => $row->url,
                                'icon' => $row->icone ?? "",
                                'label' => "",
                                'label_color' => '',
                                'submenu' => $subMenu,
                            ]
                        );


                        if (count($collection["submenu"]) <= 0) {
                            unset($collection["submenu"]);
                        }

                        $event->menu->add($collection);


                    });
                }
            }
        });




    }

    public function subMenu(&$subMenu,$row,$menugroup)
    {
        $subMenu2 = [];
        if (($menugroup[$row->id] ?? null)) {
            ($menugroup[$row->id] ?? null)->map(function ($row, $value) use (&$subMenu2,$menugroup) {

                $this->subMenu($subMenu2,$row,$menugroup);


            });
        }
        if(count($subMenu2)>0) {
            array_push($subMenu,
                [
                    'idRow' => $row->id,
                    'text' => $row->display_name,
                    'url' => $row->url,
                    'icon' => $row->icone ?? "",
                    'label_color' => '',
                    'submenu' => $subMenu2,
                ]);
        }
        else{
            array_push($subMenu,
                [
                    'idRow' => $row->id,
                    'text' => $row->display_name,
                    'url' => $row->url,
                    'icon' => $row->icone ?? "",
                    'label_color' => '',
                ]);
        }
    }
}
