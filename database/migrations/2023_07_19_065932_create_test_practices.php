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
        Schema::create('test_practices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_user_id');
            $table->unsignedBigInteger('assessor_user_id');
            $table->unsignedBigInteger('competence_criteria_id');
            $table->unsignedBigInteger('test_schedule_id');
            $table->text('case');
            $table->string('response_file')->nullable();
            $table->string('result')->nullable();
            $table->string('status')->default('unlocked');
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
        Schema::dropIfExists('test_practices');
    }
};
