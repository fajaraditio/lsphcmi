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
        Schema::create('participants_competencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->unsignedBigInteger('competency_criteria_id')->nullable();
            $table->string('status');
            $table->string('relevant_proof');
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
        Schema::dropIfExists('participants_competencies');
    }
};
