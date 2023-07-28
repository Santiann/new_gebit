<?php namespace Dealix\Faq\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;
/**
 * Question Model
 */
class Question extends Model
{
    use Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dealix_faq_questions';

    public $belongsTo = [
        'group'   => ['Dealix\Faq\Models\Group']
    ];

    public $belongsToMany = [
        'childs'    => ['Dealix\Faq\Models\Question', 'table' => 'dealix_faq_questions_related', 'key' => 'child_id', 'otherKey' => 'parent_id'],
        'parents'   => ['Dealix\Faq\Models\Question', 'table' => 'dealix_faq_questions_related', 'key' => 'parent_id', 'otherKey' => 'child_id']
    ];

    public static $sortOptions = [
        'acessed desc'   => 'Mais acessadas primeiro',
        'acessed asc'  => 'Menos acessadas primeiro'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['title','body','description'];

    public $slugs = [ 'title' => 'seo_slug' ];

    public $url;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function scopeIsPublished($query){

        $query
            ->whereNotNull('publicado')
            ->where('publicado', true);

        return $query;
    }

    public function scopeFilterCategory($query, $categorySlug){

        $query->whereHas('group',function($group) use ($categorySlug){

            $group->where('seo_slug','=',$categorySlug);

        });

        return $query;
    }

    public function scopeFilterSearch($query,$filterString){

        $query->where(function($innerQuery) use ($filterString){

            $innerQuery
                ->where('title','LIKE',"%$filterString%")
                ->orWhere('description','LIKE',"%$filterString%")
                ->orWhereHas('group',function($c) use ($filterString){

                    $c->where('title','LIKE',"%$filterString%");

                });
        });

        return $query;

    }

    public function scopeApplyFilters($query,$order,$limit){

        $query
            ->orderBy($order[0],$order[1])
            ->limit($limit);

        return $query;
    }

    public function setUrl($internalPage, $UrlProperty, $controllerInstance){

        $params = [ $UrlProperty => $this->seo_slug];
        return $this->url = $controllerInstance->pageUrl($internalPage, $params);

    }

}
