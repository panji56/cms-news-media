<?php

namespace Dimsog\Blog\Updates;

use Dimsog\Blog\Models\BreakingNews;
use Seeder;

class BreakingSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 5) as $number) {
            $Tags = new BreakingNews();
            $Tags->id = $number;
            $Tags->active = 1;
            $Tags->save();
        }
    }
}
