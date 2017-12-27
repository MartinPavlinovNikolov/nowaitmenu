<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('name');
            $table->integer('price');
            $table->string('location');
            $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
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
    }
}
