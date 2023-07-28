<?php namespace General\General\Classes\VideoParser\Types;

/**
 * Created by PhpStorm.
 * User: Hélio
 * Date: 01/10/2015
 * Time: 13:49
 */
class VimeoVideo implements VideoType
{
    public $urlVideo;

    public function __construct($urlVideo){

        $this->videoUrl = $urlVideo;
    }

    public function getThumb($extraHtml)
    {
        $image_url = parse_url($this->urlVideo, PHP_URL_PATH);
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . substr($image_url['path'], 1) . ".php"));
        return '<img src="' . $hash[0]["thumbnail_small"] . ' ' . $extraHtml . ' >';

    }

    public function getThumbUrl()
    {
        $image_url = parse_url($this->urlVideo);
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . substr($image_url['path'], 1) . ".php"));
        return $hash[0]["thumbnail_small"];
    }

    public function getVideoUrl()
    {
        $video_id = (int) substr(parse_url($this->urlVideo, PHP_URL_PATH), 1);
        return  "http://player.vimeo.com/video/$video_id";
    }

    public function getVideoEmbed($extraHtml)
    {
        $video_id = $this->getVideoId();
        return "<iframe src=\"http://player.vimeo.com/video/$video_id\" $extraHtml frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
    }

    public function getVideoId(){

        return (int) substr(parse_url($this->urlVideo, PHP_URL_PATH), 1);

    }

}