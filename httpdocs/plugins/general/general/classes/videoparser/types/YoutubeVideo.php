<?php namespace General\General\Classes\VideoParser\Types;

/**
 * Created by PhpStorm.
 * User: Hélio
 * Date: 01/10/2015
 * Time: 13:49
 */
class YoutubeVideo implements VideoType
{
    public $urlVideo;

    public function __construct($urlVideo){

        $this->videoUrl = $urlVideo;
    }

    public function getVideoUrl()
    {
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
        preg_match($pattern, $this->videoUrl, $matches);
        $video_id = $matches[1];
        $videoUrl = "http://www.youtube.com/embed/$video_id?wmode=transparent";

        return $videoUrl;
    }

    public function getVideoEmbed($extraHtml)
    {
        $videoUrl = $this->getVideoUrl();
        $iframe = "<iframe $extraHtml src=\"http://www.youtube.com/embed/$videoUrl?wmode=transparent\" frameborder=\"0\" allowfullscreen wmode=\"transparent\"></iframe>";
        return $iframe;
    }

    public function getThumbUrl()
    {
        $image_url = parse_url($this->urlVideo);
        $array = explode("&", $image_url['query']);
        return 'http://img.youtube.com/vi/' . substr($array[0], 2) . '/0.jpg';
    }

    public function getThumb($extraHtml)
    {
        $urlDaImagem = $this->getThumbUrl();
        return "<img $extraHtml src='$urlDaImagem' >";
    }

    public function getVideoId()
    {
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
        preg_match($pattern, $this->urlVideo, $matches);

        return $matches[1];
    }

}