<?php namespace Dealix\Faq\Models;

use \Model;
use October\Rain\Database\Traits\Sluggable;

/**
 * FaqGroup Model
 */
class Group extends Model
{
    use Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dealix_faq_groups';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    /**
     * @var array Validation rules
     */
    public $rules = [];

    public $slugs = [ 'name' => 'seo_slug' ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'questions' => ['\Dealix\Faq\Models\Question', 'key' => 'group_id']
    ];

    public $url;


    public function setUrl($internalPage, $UrlProperty, $controllerInstance){

        $params = [ $UrlProperty => $this->seo_slug];
        return $this->url = $controllerInstance->pageUrl($internalPage, $params);

    }
}
