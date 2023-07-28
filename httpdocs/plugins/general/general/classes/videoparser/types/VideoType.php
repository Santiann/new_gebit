<?php namespace General\General\Classes\VideoParser\Types;

/**
 * Created by PhpStorm.
 * User: Hélio
 * Date: 01/10/2015
 * Time: 13:49
 */
interface VideoType
{
    public function __construct($urlVideo);

    public function getVideoEmbed($extraHtml);

    public function getThumb($extraHtml);

    public function getVideoUrl();

    public function getThumbUrl();

    public function getVideoId();
}