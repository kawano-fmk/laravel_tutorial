<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id'); //1から順に増えていく
            $table->string('title');
            $table->text('content');
            $table->timestamps(); 
      });
    }

    /**
     * Reverse the migrations.
    *
     * @return void
     */
    public function down()
    {
      Schema::drop('posts');
    }
}
