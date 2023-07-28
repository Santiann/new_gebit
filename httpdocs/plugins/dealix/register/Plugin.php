<?php namespace Dealix\Register;

use Backend;
use System\Classes\PluginBase;
use Dealix\Register\Classes\Register;
use Dealix\Register\Classes\Password;
use RainLab\User\Models\User;
use Dealix\Register\Models\User_Auth;
use Auth;
use Event;
/**
 * register Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'register',
            'description' => 'Extending uploadForm from magicforms',
            'author'      => 'dealix',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::listen('rainlab.user.beforeRegister', function(&$data) {
            $user = Register::registerOnSystem(post());
            $data['password'] = $data['password_confirmation'] = $user->password;
        });
        // Event::listen('rainlab.user.register', function() {
        //     Password::onRestorePassword();
        // });

        // antes de alterar senha pelo site, altera a do sistema
        User::extend(function($model) {
            $model->bindEvent('model.beforeUpdate', function() use ($model) {
                Password::changePasswordOnSystem($model->email, $model->password);
            });
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Dealix\Register\Components\Localization' => 'localization',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'dealix.register.some_permission' => [
                'tab' => 'register',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'register' => [
                'label'       => 'register',
                'url'         => Backend::url('dealix/register/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['dealix.register.*'],
                'order'       => 500,
            ],
        ];
    }
}
