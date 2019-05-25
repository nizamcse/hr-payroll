<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bonus_id')->unsigned();
            $table->integer('salary_id')->unsigned();
            $table->float('amount')->default(0);
            $table->timestamps();
            $table->foreign('salary_id')->references('id')->on('employee_salaries')->onDelete('cascade');
            $table->foreign('bonus_id')->references('id')->on('bonuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_bonuses');
    }
}
