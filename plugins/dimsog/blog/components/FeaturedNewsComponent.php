<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Models\FeaturedNews;
use Winter\Storm\Database\Collection;
use Illuminate\Support\Facades\Log;

class FeaturedNewsComponent extends ComponentBase
{

    private Collection $posts;

    public function onRun()
    {
        $this->posts = FeaturedNews::orderBy('id','asc')->get();
    }

    public function onRender()
    {
        $this->page['items'] = $this->posts;
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'Featured News Page',
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
