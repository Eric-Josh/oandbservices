<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralMerchandise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_merchandise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchandise_id');
            $table->bigInteger('phone')->length(10);
            $table->text('description');
            $table->integer('amount');
            $table->string('time_frame');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_to');
            $table->string('location');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('merchandise_id')->references('id')->on('merchandise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_merchandise');
    }
}
