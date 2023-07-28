<?php namespace General\Paginas\Classes;

use General\Paginas\Models\Conteudo;
use General\Paginas\Models\Pagina;
use \Cms\Classes\Page as ParentPage;
use Cms\Classes\Theme;
use October\Rain\Extension\ExtendableTrait;
use General\Translate\Models\Locale;
use System\Models\PluginVersion;

/**
 * Class to represent a physical page on active theme
 *
 * Class Page
 * @package General\Paginas\Classes
 */
class Page extends \Model
{
    /** @var  array Array cache for lang queries reduction */
    protected $fieldsArrayCache = [];

    /** @var array Translatable fields dynamically populated by conteudo controller */
    public $translatable = [];

    //public $implement = ['@General.Paginas.Behaviors.PageTranslatableModel'];

    protected $page;

    public $exists;


    /**
     * Overwrite to store the theme
     * @param array $attributes Attributes for initialization
     * @param Theme|null $theme
     */
    public function __construct($attributes = [], Theme $theme = null)
    {
        $this->themeCache = $theme;
    }

    /**
     * Define how an translatable attribute should be retrieved
     * @param string $fieldName
     * @param string $localeCode
     * @return mixed
     */
    public function getAttributeTranslated($fieldName, $localeCode = null, bool $repeater = false)
    {
        $pageUrl = $this->getSettings('url');
        //$startCursor = strpos($fieldName,'[');
        //$endCursor = strpos($fieldName,']');
        //$fieldName = substr($fieldName,$startCursor+1, $endCursor-$startCursor-1);

        $fieldName = str_replace(FormWidgetBuilder::fistLevelPage . '[', '', $fieldName);
        $fieldName = str_replace(']', '', $fieldName);

        $pageContent = Conteudo::findPageContent($pageUrl);
        $model = Pagina::findPage($pageUrl);
        $defaultLocale = Locale::getDefault();

        if ($model == null) {
            return;
        }

        if ($this->fieldsArrayCache == null) {
            $obj = \Db::table('general_translate_attributes')
                ->where('model_id', $model->id)
                ->where('model_type', get_class($model))
                ->get();

            foreach ($obj as $item) {
                $this->fieldsArrayCache[$item->locale] = json_decode($item->attribute_data, true);
            }
        }

        $localeFields =& $this->fieldsArrayCache;
        $fieldValue = $this->getValueRecursively($localeFields[$localeCode], $fieldName);

        if($repeater) {
            $fieldValue = $this->recursiveDecodeRepeater($fieldValue);
        }

        return $fieldValue;

//     	array_walk_recursive($localeFields,function(&$item, $key) use ($fieldName,&$fieldValue){

//     		if(($key == $fieldName) && ($fieldValue == null && $item != null))
//     		{
//     			$fieldValue = $item;
//     			$item = null;
//     			return $item;
//     		}
//     	});

//     	return $fieldValue;
    }

    protected function recursiveDecodeRepeater($value)
    {
        if (is_string($value)) {
            return $this->recursiveDecodeRepeater(json_decode($value));
        }

        return $value;
    }

    private function getValueRecursively(&$array, $fieldSearchFor)
    {
        if (!is_array($array)) {
            return;
        }

        $return = null;

        foreach ($array as $field => &$value) {
            if (is_array($value)) {
                $return = $this->getValueRecursively($value, $fieldSearchFor);
            } else {
                if ($field == $fieldSearchFor && $value != null) {
                    $valueCache = $value;
                    $value = null;
                    $return = $valueCache;
                }
            }

            if ($return != null) {
                return $return;
            }
        }
    }

    /**
     * @param null $firstLevel
     * @param null $secondLevel
     * @param null $thirdLevel
     * @return Page
     */
    public function loadPage($firstLevel = null, $secondLevel = null, $thirdLevel = null, $keepContent = true)
    {
        $path = $firstLevel;
        if ($secondLevel != null) {
            $path .= '/' . $secondLevel;
        };
        if ($thirdLevel != null) {
            $path .= '/' . $thirdLevel;
        };

        $page = ParentPage::load($this->themeCache, $path);

        if (PluginVersion::where('code', 'General.Translate')->applyEnabled()->exists()) {
            $this->extendClassWith('General\Paginas\Behaviors\PageTranslatableModel');
        }

        if (!$keepContent) {
            $page->releaseContent();
        }

        return $this->page = $page;
    }

    /**
     * Method for releasing the useless content for some determined operations
     */
    public function releaseContent()
    {
        unset($this->content);
        unset($this->markup);
        unset($this->original);
    }

    /**
     * Returns one given setting of its default
     * @param string $key Setting Key
     * @param string $default Default if setting hasn't found
     * @return mixed
     */
    public function getSettings($key, $default = '')
    {
        return array_get($this->page->settings, $key, $default);
    }

    /**
     * Define one setting value
     * @param mixed $key Where to store
     * @param mixed $value What to store
     */
    public function setSettings($key, $value)
    {
        $this->page->settings[$key] = $value;
    }

    /**
     * Sync settings from page object with incoming settings array
     * @param array $settings
     */
    public function updateSettings(array $settings)
    {
        $path = array_get($settings, 'url', $this->getSettings('url'));
        $title = array_get($settings, 'title', $this->getSettings('title'));
        $meta_title = array_get($settings, 'seo_title', $this->getSettings('meta_title'));
        $meta_description = array_get($settings, 'seo_description', $this->getSettings('meta_description'));

        $this->setSettings('url', $path);
        $this->setSettings('title', $title);
        $this->setSettings('meta_title', $meta_title);
        $this->setSettings('meta_description', $meta_description);

        $this->page->components = $this->page->settings['components'];
        $this->page->settings += $this->page->settings['components'];

        unset($this->page->settings['components']);
        $this->page->save();
    }

    public function getCmsPage()
    {
        return $this->page;
    }
}