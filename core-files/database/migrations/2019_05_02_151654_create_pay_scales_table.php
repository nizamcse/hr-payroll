<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_scales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('company_id')->unsigned()->nullable();
            $table->double('basic')->default(0);
            $table->double('house_rent')->default(0);
            $table->double('medical')->default(0);
            $table->double('convey')->default(0);
            $table->double('food')->default(0);
            $table->double('gross_salary')->default(0);
            $table->double('ot_salary_per_hour')->default(0);
            $table->double('att_bonus')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('pay_scales');
    }
}
