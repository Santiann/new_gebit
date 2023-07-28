<?php

namespace General\BackendUser\Classes\Event;

use Backend\Controllers\Users;
use Backend\Models\User;
use Backend\Widgets\Form;
use October\Rain\Events\Dispatcher;

class ExtendBackendUser
{
    public function subscribe(Dispatcher $event)
    {
        Users::extendFormFields(function (Form $form, $model, $context) {

            if (!$model instanceof User) {
                return;
            }

            $form->addTabFields([
                'bio' => [
                    'label' => 'Bio',
                    'type'  => 'textarea',
                    'size'  => 'tiny',
                    'tab'   => ''
                ],
            ]);
        });
    }
}
