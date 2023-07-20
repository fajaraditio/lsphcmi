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
        Schema::create('test_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_user_id')->nullable();
            $table->unsignedBigInteger('assessor_user_id')->nullable();
            $table->unsignedBigInteger('test_session_id')->nullable();
            $table->date('scheduled_at')->nullable();
            $table->string('participant_status')->default('signing_agreement');
            $table->string('assessor_status')->default('signing_agreement');
            $table->datetime('participant_signed_agreement_at')->nullable();
            $table->datetime('assessor_signed_agreement_at')->nullable();
            $table->datetime('participant_responded_test_practice_at')->nullable();
            $table->datetime('assessor_submitted_test_practice_at')->nullable();
            $table->datetime('participant_responded_test_observation_at')->nullable();
            $table->datetime('assessor_submitted_test_observation_at')->nullable();
            $table->datetime('participant_responded_feedback_at')->nullable();
            $table->datetime('assessor_submitted_report_at')->nullable();
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
        Schema::dropIfExists('test_schedules');
    }
};
