<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('year');
            $table->tinyInteger('month');
            $table->tinyInteger('total_attend')->nullable();
            $table->tinyInteger('total_leave')->nullable();
            $table->tinyInteger('weekends')->nullable();
            $table->tinyInteger('working_days')->nullable();
            $table->tinyInteger('absent')->nullable();
            $table->tinyInteger('holidays')->nullable();
            $table->float('basic_salary')->default(0);
            $table->float('bonuses_amount')->default(0);
            $table->float('deductions_amount')->default(0);
            $table->float('funds_amount')->default(0);
            $table->boolean('status')->default(false);
            $table->float('net_salary')->default(0);
            $table->float('total_ot')->default(0);
            $table->float('total_ot_amount')->default(0);
            $table->float('paid_amount')->default(0);
            $table->float('due_amount')->default(0);
            $table->float('att_bonus')->default(0);
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salaries');
    }
}
