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
            $table->string('axis_h')->nullable();
            $table->string('purchase_method')->nullable();
            $table->string('jockey')->nullable();
            $table->string('father')->nullable();
            $table->string('mother_father')->nullable();
            $table->string('condition_course')->nullable();
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
