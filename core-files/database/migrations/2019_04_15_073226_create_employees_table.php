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
            $table->increments('id');
            $table->integer('employee_id')->nullable();
            $table->string('name');
            $table->integer('designation_id')->unsigned()->nullable();
            $table->integer('section_id')->unsigned()->nullable();
            $table->integer('line_id')->unsigned()->nullable();
            $table->bigInteger('pay_scale_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('contact_no')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('company_id')->unsigned()->nullable();
            $table->boolean('shift')->default(false);
            $table->tinyInteger('salary_type')->default(1);
            $table->time('in_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->float('minimum_working_hour',5,2)->nullable();
            $table->date('joining_date')->nullable();
            $table->boolean('count_ot')->default(0);
            $table->timestamps();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
