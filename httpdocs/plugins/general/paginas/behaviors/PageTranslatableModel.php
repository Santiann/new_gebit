<?php namespace General\Paginas\Behaviors;

use Db;
use General\Translate\Classes\TranslatableBehavior;

class PageTranslatableModel extends TranslatableBehavior
{
    private static $pageCacheLang;

    protected function loadTranslatableData($locale = null)
    {   	
        if (!$locale) {
            $locale = $this->translatableContext;
        }

        if (!$this->model->exists) {
            return $this->translatableAttributes[$locale] = [];
        }

//         if(self::$pageCacheLang == null)
//         {
            $pagina = $this->model->paginaModel;

            $obj = Db::table('general_translate_attributes')
                ->where('locale', $locale)
                ->where('model_id', $pagina->getKey())
                ->where('model_type', get_class($pagina))
                ->first();

            $result = $obj ? json_decode($obj->attribute_data, true) : [];
            self::$pageCacheLang = $result;
//         }

        return $this->translatableOriginals[$locale] = $this->translatableAttributes[$locale] = self::$pageCacheLang;
    }

    public function storeTranslatableData($locale = null)
    {
        //@todo Em Futuras versões, combinar ou estabelecer relações entre o Translator driver e essa classe
    }

    public function getAttributeTranslated($key, $locale = null)
    {
        $key = $this->model->identificador;
        return parent::getAttributeTranslated($key, $locale);
    }
}