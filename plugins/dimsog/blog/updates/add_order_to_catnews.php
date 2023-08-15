<?php namespace Dimsog\Blog\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Illuminate\Support\Facades\Log;

class AddOrderToCatnews extends Migration
{
    public function up()
    {
        Schema::table('CatNews_Table', function (Blueprint $table) {
            $table->unsignedInteger('order')->nullable();
        });
    }

    public function down()
    {

    }
}


