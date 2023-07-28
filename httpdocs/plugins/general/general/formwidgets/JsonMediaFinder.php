<?php namespace General\General\FormWidgets;

use Lang;
use ApplicationException;
use Backend\Classes\FormWidgetBase;

/**
 * Media Finder
 * Renders a record finder field.
 *
 *    image:
 *        label: Some image
 *        type: media
 *        prompt: Click the %s button to find a user
 * 
 * @package october\cms
 * @author Alexey Bobkov, Samuel Georges
 */
class JsonMediaFinder extends FormWidgetBase
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
        $this->prepareVars();
        return $this->makePartial('mediafinder');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['fileList'] = $this->getImageList();

        $this->vars['field']    = $this->formField;
        $this->vars['prompt']   = str_replace('%s', '<i class="icon-folder"></i>', $this->prompt);
        $this->vars['mode']     = $this->mode;
    }

    /**
     * Transforma o resultado em uma arrayMap de infos das imagens salvas
     * Ser� usado para passar os dados para carregar as imagens j� salvas
     * @return array
     */
    private function getImageList()
    {
        $resultList = [];
        $value = $this->getLoadValue();

        $arrayValue = is_array($value) ? $value : json_decode($value,true);
        $arrayValue = empty($arrayValue) ? [] : $arrayValue;

        foreach($arrayValue as $c => $item){

            $imageName = explode('/',$item);
            $imageName = end($imageName);

            $resultList[$c]['location'] = $item;
            $resultList[$c]['name']     = $imageName;
            $resultList[$c]['value']    = $item;

            /**
             * @TODO Pegar o tipo do arquivo para selecionar a devida exibi��o.
             */
            $type = 'image';
            if($type == 'audio'){
                $thumb = '<i style="margin: 18px" class="icon-music"></i>';

            }else if ($type == 'image'){
                $thumb = '<img src="'.$resultList[$c]['location'].'" />';

            }else if($type == 'video'){
                $thumb = '<i style="margin: 20px" class="icon-video-camera"></i>';

            }else{
                $thumb = '<i style="margin: 20px" class="icon-file"></i>';
            }

            $resultList[$c]['thumb']    = $thumb;
        }

        return $resultList;
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addJs('js/jsonmediafinder.js', 'core');
        $this->addJs('js/jquery-ui.min.js', 'core');
        $this->addCss('css/mediafinder.css', 'core');
        $this->addCss('css/fileupload.css', 'core');
    }

    public function onRemoveItem()
    {
        // Useful for deleting relations
    }
}