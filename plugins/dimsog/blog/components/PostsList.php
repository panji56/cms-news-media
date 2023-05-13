<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Classes\PostsReader;
use Dimsog\Blog\Models\Category;
use Dimsog\Blog\Models\Tag;
use Dimsog\Blog\Models\PostTag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Winter\Storm\Database\Collection;

class PostsList extends ComponentBase
{
    private ?Category $category;

    private LengthAwarePaginator $posts;

    private ?Tag $tag_id;

    // private Collection $pg;

    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blog::lang.components.posts_list.name',
            'description' => ''
        ];
    }

    public function onRun()
    {
        $reader = new PostsReader(intval($this->property('limit')),intval($this->property('page')));
        $slug = $this->property('categorySlug');
        $slugtag = $this->property('tag');
        $this->category = Category::findBySlug($slug);
        $this->tag_id = Tag::findBySlug($this->property('tag'));
        //$this->pg = PostTag::where('tag_id','=',(int) $this->tag_id?->id)->lists('post_id');
        if (empty($slug) == false && $this->category == null) {
            return $this->controller->run('404');
        }
        $reader->setCategoryId((int) $this->category?->id);
        $reader->setTagId((int) $this->tag_id?->id);
        $this->posts = $reader->read();
        if (empty($this->category) == false) {
            $this->page->title = $this->category->name;
        }
        $this->page['activeCategory'] = $this->category;
    }

    public function onRender(): void
    {
        $this->page['category'] = $this->category;
        $this->page['items'] = $this->posts;
        $this->page['counts'] = $this->posts->count();
        $this->page['limit'] = intval($this->property('limit'));
        //$this->page['tgs'] =  $this->pg;
    }

    public function defineProperties(): array
    {
        return [
            'categorySlug' => [
                'title' => 'dimsog.blog::lang.components.posts_list.category_slug',
                'description' => '',
                'default' => null,
                'type' => 'string'
            ],
            'limit' => [
                'title' => 'dimsog.blog::lang.components.posts_list.limit',
                'default' => 20
            ],
            'page' => [
                'title' => 'page number',
                'default' => 1
            ],
            'tag' => [
                'tittle' => 'tag',
                'description' => '',
                'default' => null,
                'type' => 'string'
            ]
        ];
    }
}
