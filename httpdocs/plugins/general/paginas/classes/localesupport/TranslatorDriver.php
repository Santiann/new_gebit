<?php namespace General\Paginas\Classes\LocaleSupport;

use General\Paginas\Classes\FormWidgetBuilder;
use General\Paginas\Classes\Page;
use General\Paginas\Models\Conteudo;
use General\Paginas\Models\Pagina;
use General\Translate\Models\Locale;


class TranslatorDriver
{
    /** @var Page */
    protected $currentPage;

    protected $firstLevel;

    public function __construct($currentPage)
    {
        $this->currentPage = $currentPage;
        $this->firstLevel = FormWidgetBuilder::fistLevelPage;
    }

    public function updateTranslations($page)
    {
        $translatableFields = \Request::input('RLTranslate', []);
        $originalFields = \Request::input($this->firstLevel, []);
        $defaultLocale = Locale::getDefault();

        foreach ($translatableFields as $localeCode => $languages) {

            $localeContent = array_get($languages, $this->firstLevel);
            $localeSettings = array_get($languages, 'settings');

            $this->updateSingleLocale($localeCode, $localeContent, $localeSettings, $page);

            if ($localeCode == $defaultLocale->code) {
                $this->updateDefault($localeContent, $localeSettings, $originalFields, $page);
            }
        }
    }

    protected function updateSingleLocale($localeCode, $localeContent = [], $localeSettings = [], $page)
    {
        if ($localeContent == null) {
            $localeContent = [];
        }

        if (is_array($localeSettings))
            $contentToSave = array_merge($localeContent, $localeSettings);
        else
            $contentToSave = array_merge($localeContent, []);

        $this->storeLanguage($contentToSave, $localeCode, $page);
    }

    protected function storeLanguage($localeData, $localeCode, $page)
    {
        $modelObject = Pagina::where('identificador', $this->currentPage->getSettings('url'))->first();

        \Db::table('general_translate_attributes')
            ->where('locale', $localeCode)
            ->where('model_id', $modelObject->getKey())
            ->where('model_type', get_class($modelObject))
            ->delete();

        \Db::table('general_translate_attributes')->insert([
            'locale'         => $localeCode,
            'model_id'       => $modelObject->getKey(),
            'model_type'     => get_class($modelObject),
            'attribute_data' => json_encode($localeData)
        ]);
    }

    protected function updateDefault($localeContent = [], $localeSettings = [], $originalFields = [], $page)
    {
        if ($localeContent == null) {
            $localeContent = [];
        }

        if (is_array($localeSettings))
            $contentToSave = array_merge($localeContent, $localeSettings);
        else
            $contentToSave = array_merge($localeContent, []);

        foreach ($contentToSave as $key => $item) {
            $array = json_decode($item);
            if (json_last_error() === JSON_ERROR_NONE && is_array($array))
                $contentToSave[$key] = $array;
        }

        Conteudo::updatePage($contentToSave, $page);

        $url = $page->getSettings('url');
        $metaTitle = array_get($localeSettings, 'seo_title');
        $metaDescription = array_get($localeSettings, 'seo_description');

        Pagina::updatePageSettings($url, $metaTitle, $metaDescription);
    }
}