<?php namespace Dimsog\Blog\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\Log;

class AddSitetypeToCategories extends Migration
{
    public function up()
    {
        Log::info('Check if');
        Schema::table('dimsog_blog_categories', function (Blueprint $table) {
            $table->string('site_type')->nullable();
        });
    }

    public function down()
    {

    }
}


