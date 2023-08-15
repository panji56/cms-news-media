<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Models\CatNews;
use Winter\Storm\Database\Collection;
use Illuminate\Support\Facades\Log;

class CatView extends ComponentBase
{

    private Collection $posts;
    private Collection $cats;

    public function onRun()
    {
        $this->posts = CatNews::all();
        $this->cats = CatNews::select('category')->distinct()->get();
    }

    public function onRender()
    {
        $this->page['items'] = $this->posts;
        $this->page['cats'] = $this->cats;
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'Category View List',
            'description' => ''
        ];
    }

    // public function defineProperties(): array
    // {
    //     return [
    //         'slug' => [
    //             'title' => 'dimsog.blog::lang.components.tag_view.slug',
    //             'description' => '',
    //             'default' => null,
    //             'type' => 'string'
    //         ],
    //     ];
    // }
}
