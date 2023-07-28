<?php namespace General\Translate\Models;

use System\Models\File as FileBase;

/**
 * MLFile makes file attachments translatable
 *
 * @package general\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLFile extends FileBase
{
    /**
     * @var array implement behaviors
     */
    public $implement = [
        \General\Translate\Behaviors\TranslatableModel::class
    ];

    /**
     * @var array translatable attributes
     */
    public $translatable = ['title', 'description'];
}
