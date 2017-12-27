<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablets', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('name');
            $table->integer('employer_id')->unsigned();
            $table->dateTime('last_login');
            $table->timestamps();
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
        Schema::dropIfExists('employee_tablet');
        Schema::dropIfExists('tablets');
    }
}
