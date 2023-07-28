<?php namespace General\General\Classes\VideoParser;

use General\General\Classes\VideoParser\Types\VideoType;
use General\General\Classes\VideoParser\Types\VimeoVideo;
use General\General\Classes\VideoParser\Types\YoutubeVideo;

class VideoDriver
{
    private $videoUrl;
    /**
     * @var VideoType
     */
    private $videoObject;

    public function __construct($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        //Type Definition
        if(strripos($this->videoUrl, "youtu"))
        {
            $this->videoObject = new YoutubeVideo($this->videoUrl);

        }elseif(strripos($this->videoUrl, "vimeo")){

            $this->videoObject = new VimeoVideo($this->videoUrl);
        }

    }

    public function getVideoEmbed(array $attributes = array()){

        if($this->videoObject == null)
        {
            return '';
        }
        $extraHtml = $this->arrayToAttributes($attributes);
        return $this->videoObject->getVideoEmbed($extraHtml);
    }

    public function getThumb(array $attributes = array()){

        if($this->videoObject == null)
        {
            return '';
        }
        $extraHtml = $this->arrayToAttributes($attributes);
        return $this->videoObject->getThumb($extraHtml);

    }

    public function getVideoUrl(){

        if($this->videoObject == null)
        {
            return '';
        }

        return $this->videoObject->getVideoUrl();

    }

    public function getThumbUrl(){

        if($this->videoObject == null)
        {
            return '';
        }
        return $this->videoObject->getVideoUr();

    }

    private function arrayToAttributes($attributes){

        $extraHtml = '';
        foreach($attributes as $key => $value){
            $extraHtml .= $key.'="'.$value.'" ';
        }

        return $extraHtml;

    }

}
