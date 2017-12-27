<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')
                    ->references('id')
                    ->on('employers')
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
        Schema::dropIfExists('pages');
        Schema::dropIfExists('menu');
    }
}
