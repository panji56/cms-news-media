<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoriesList extends ComponentBase
{
    private Collection $categories;


    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blog::lang.components.categories_list.name',
            'description' => ''
        ];
    }

    public function defineProperties(): array
    {
        return [
            'SiteType' => [
                'title' => 'Site Type',
                'description' => '',
                'default' => 'news',
                'type' => 'string'
            ]
        ];
    }

    public function onRun(): void
    {
        $this->categories = Category::where('active', 1)
            ->where('hidden', 0)
            ->where('site_type',$this->property('SiteType'))
            ->orderBy('position')
            ->get();
    }

    public function onRender()
    {
        $this->page['items'] = $this->categories;
    }
}
