<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->string('job_title')->length(100);
            $table->bigInteger('phone')->length(12);
            $table->text('description');
            $table->integer('amount');
            $table->string('time_frame');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->string('photo');
            $table->string('location');
            $table->string('reference_id');
            $table->datetime('date_requested');
            $table->datetime('date_completed');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('job_id')->references('id')->on('job_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
