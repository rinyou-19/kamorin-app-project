<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('race_day');
            $table->string('race_course');
            $table->string('grade');
            $table->string('race_name');
            $table->string('dirt_or_turf');
            $table->integer('distance');
            $table->integer('purchase_m');
            $table->integer('return_m');
            $table->integer('balance_m');
            $table->string('axis_h');
            $table->string('purchase_method');
            $table->string('jockey');
            $table->string('father');
            $table->string('mother_father');
            $table->integer('gate_no');
            $table->string('condition_course');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
