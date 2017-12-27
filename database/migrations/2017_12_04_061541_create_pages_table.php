<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('header');
            $table->foreign('menu_id')
                    ->references('id')
                    ->on('menu')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('pages');
    }
}
