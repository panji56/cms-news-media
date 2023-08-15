<?php namespace Dimsog\Blog\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\Log;

class CreateCatNews extends Migration
{
    public function up()
    {
        Schema::create('CatNews_Table', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id');
            $table->unsignedTinyInteger('active')->default(0);
            $table->string('category')->nullable();
            $table->unsignedInteger('post_id')->nullable();
            $table->primary('id');
            $table->foreign('post_id')->references('id')->on('dimsog_blog_posts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('CatNews_Table');
    }
}
