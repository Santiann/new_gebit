<?php namespace RainLab\Blog\Components;

use Cms\Classes\ComponentBase;
use \RainLab\Blog\Models\Post as PostModel;

/**
 * Related Component
 */
class Related extends ComponentBase
{
    protected $related;

    public function componentDetails()
    {
        return [
            'name'        => 'Related Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'description' => 'Post slug',
                'title'       => 'Slug',
                'default'     => '{{:slug}}',
                'type'        => 'string'
            ]
        ];
    }

    public function getRelated()
    {
        if (null !== $this->related)
            return $this->related;

        if ($this->property('slug')) {

            $slug = $this->property('slug');

            $post = PostModel::where('slug', $slug)->first();
            if (!$post)
                return null;

            $this->related = $post->related()
                ->where('slug', '!=', $slug)
                ->where('id', '!=', $post->id)->get();

            return $this->related;
        }
    }
}
