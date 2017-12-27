<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('employer_id')->unsigned();
            /* pin code */
            $table->string('password');
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
        Schema::dropIfExists('employee_order');
        Schema::dropIfExists('employee_total');
        Schema::dropIfExists('tables');
        Schema::dropIfExists('employees');
    }

}
