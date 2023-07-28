<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 09/09/18
 * Time: 15:58
 */

namespace General\Painel\Classes;

use Backend\Classes\NavigationManager;

class BackendMenu
{
    private static $moduleCodes = ['OCTOBER.CMS.CMS','OCTOBER.BACKEND.MEDIA','OCTOBER.SYSTEM.SYSTEM'];


    private static $menuItens = [];

    public static function loadMenu(){

        if(!self::$menuItens)
        {
            self::$menuItens = \BackendMenu::listMainMenuItems();
        }

        return self::$menuItens;

    }

    public static function listMenu(){

        self::loadMenu();
        $arrayMenu = self::$menuItens;

        array_forget($arrayMenu, self::$moduleCodes );

        return ($arrayMenu);
    }

    public static function getModuleItem($menuCode){

        self::loadMenu();
        return array_get(self::$menuItens, $menuCode);
    }
}
