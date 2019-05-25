<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('deduction_id')->unsigned();
            $table->integer('salary_id')->unsigned();
            $table->float('amount')->default(0);
            $table->timestamps();
            $table->foreign('salary_id')->references('id')->on('employee_salaries')->onDelete('cascade');
            $table->foreign('deduction_id')->references('id')->on('deduction_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_deductions');
    }
}
