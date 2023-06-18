<?php

namespace Dimsog\Blog\Updates;

use Dimsog\Blog\Models\PostType;
use Dimsog\Blog\Models\NewsFront;
use Seeder;

class TagsSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 7) as $number) {
            $Tags = new NewsFront();
            $Tags->id = $number;
            $Tags->active = 1;
            $Tags->save();
        }
    }
}
