<?php

namespace Dimsog\Blog\Updates;

use Dimsog\Blog\Models\FeaturedNews;
use Seeder;

class FeaturedSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $number) {
            $Tags = new FeaturedNews();
            $Tags->id = $number;
            $Tags->active = 1;
            $Tags->save();
        }
    }
}
