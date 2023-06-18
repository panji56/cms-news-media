<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Models\NewsFront;
use Winter\Storm\Database\Collection;
use Illuminate\Support\Facades\Log;

class NewsFrontList extends ComponentBase
{

    private Collection $posts;

    public function onRun()
    {
        $this->posts = NewsFront::all();
    }

    public function onRender()
    {
        $this->page['items'] = $this->posts;
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'News Front List',
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
        ];
    }
}
