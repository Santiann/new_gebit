<?php namespace General\Translate\FormWidgets;

use Backend\Classes\FormWidgetBase;
use General\Translate\Models\Locale;

/**
 * ML Text
 * Renders a multi-lingual text field.
 *
 * @package general\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLText extends FormWidgetBase
{
    use \General\Translate\Traits\MLControl;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'mltext';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->initLocale();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareLocaleVars();

        if ($this->isAvailable) {
            return $this->makePartial('mltext');
        }
        else {
            return $this->renderFallbackField();
        }
    }

    /**
     * Returns an array of translated values for this field
     * @return array
     */
    public function getSaveValue($value)
    {
        return $this->getLocaleSaveValue($value);
    }

    /**
     * {@inheritDoc}
     */
    protected function loadAssets()
    {
        $this->loadLocaleAssets();
    }
}
