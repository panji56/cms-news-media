<?php

namespace Dimsog\Blog\Updates;

use Dimsog\Blog\Models\PostType;
use Dimsog\Blog\Models\Tag;
use Seeder;

class TagsSeeder extends Seeder
{
    public function run()
    {
        $tag = new Tag();
            $tag->name = 'Breaking';
            $tag->save();
        $tag = new Tag();
            $tag->name = 'Trending';
            $tag->save();
        $tag = new Tag();
            $tag->name = 'Featured';
            $tag->save();
    }
}
