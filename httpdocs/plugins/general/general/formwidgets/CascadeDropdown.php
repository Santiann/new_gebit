<?php namespace General\General\FormWidgets;

use Lang;
use ApplicationException;
use Backend\Classes\FormWidgetBase;


class CascadeDropdown extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var string Prompt to display if no record is selected.
     */
    public $prompt = 'Click the %s button to find a media item';

    /**
     * @var string Display mode for the selection. Values: file, image.
     */
    public $mode = 'file';

    //
    // Object properties
    //

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'media';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'mode',
            'prompt'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return $this->makePartial('default');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['fileList'] = $this->getImageList();

        $this->vars['field'] = $this->formField;
        $this->vars['prompt'] = str_replace('%s', '<i class="icon-folder"></i>', $this->prompt);
        $this->vars['mode'] = $this->mode;
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {

    }

}