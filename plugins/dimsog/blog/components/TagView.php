<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Classes\PostsReader;
use Dimsog\Blog\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TagView extends ComponentBase
{
    private ?Tag $tag;

    private LengthAwarePaginator $posts;

    private Collection $tags;

    public function onRun()
    {
        $tag = Tag::findBySlug($this->property('slug'));
        if (empty($tag)) {
            $this->tags = Tag::all();
            $this->tag = $tag;
            //return $this->controller->run('404');
        }else{
            $reader = (new PostsReader())
            ->setTagId($tag->id);
            $reader->setSiteType($this->property('SiteType'));
            $this->tag = $tag;
            $this->posts = $reader->read();
            $this->page->title = $tag->name;
        }
    }

    public function onRender()
    {
        if(empty($this->tag)){
            $this->page['tags'] = $this->tags;
        }else{
            $this->page['tag'] = $this->tag;
            $this->page['items'] = $this->posts;
        }
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blog::lang.components.tag_view.name',
            'description' => ''
        ];
    }

    public function defineProperties(): array
    {
        return [
            'slug' => [
                'title' => 'dimsog.blog::lang.components.tag_view.slug',
                'description' => '',
                'default' => null,
                'type' => 'string'
            ],
            'SiteType' => [
                'title' => 'Site Type',
                'description' => '',
                'default' => 'news',
                'type' => 'string'
            ]
        ];
    }
}
