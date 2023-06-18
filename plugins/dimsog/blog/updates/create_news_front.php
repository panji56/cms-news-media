<?php namespace Dimsog\Blog\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\Log;

class CreateNewsFront extends Migration
{
    public function up()
    {
        Schema::dropIfExists('NewsFront_tags');
        Schema::create('NewsFront_tags', function (Blueprint $table) {
            Log::info('Test Migration');
            $table->engine = 'InnoDB';
            $table->unsignedInteger('id');
            $table->unsignedTinyInteger('active')->default(0)->index();
            $table->unsignedInteger('post_id')->nullable();
            $table->primary('id');
            $table->foreign('post_id')->references('id')->on('dimsog_blog_posts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('NewsFront_tags');
    }
}
