<?php

namespace Dimsog\Blog\Updates;

use Dimsog\Blog\Models\TrendingNews;
use Seeder;

class TrendingSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 5) as $number) {
            $Tags = new TrendingNews();
            $Tags->id = $number;
            $Tags->active = 1;
            $Tags->save();
        }
    }
}
