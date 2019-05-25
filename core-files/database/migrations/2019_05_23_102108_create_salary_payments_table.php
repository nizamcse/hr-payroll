<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('employee_salary_id')->unsigned()->nullable();
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->float('amount')->default(0);
            $table->bigInteger('payment_status')->default(false);
            $table->date('payment_date')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('employee_salary_id')->references('id')->on('employee_salaries')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_payments');
    }
}
