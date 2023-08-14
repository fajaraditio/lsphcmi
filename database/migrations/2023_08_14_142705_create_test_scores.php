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
        Schema::create('test_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_schedule_id')->nullable();
            $table->unsignedBigInteger('participant_user_id')->nullable();
            $table->unsignedBigInteger('assessor_user_id')->nullable();
            $table->unsignedBigInteger('scoring_component_id')->nullable();
            $table->unsignedBigInteger('scoring_criteria_id')->nullable();
            $table->integer('score')->nullable();
            $table->integer('weight')->nullable();
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
        Schema::dropIfExists('test_scores');
    }
};
