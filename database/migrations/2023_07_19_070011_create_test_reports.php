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
        Schema::create('test_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_user_id');
            $table->unsignedBigInteger('assessor_user_id');
            $table->unsignedBigInteger('test_schedule_id');
            $table->string('result')->nullable();
            $table->text('aspect_notes')->nullable();
            $table->text('rejection_notes')->nullable();
            $table->text('fixing_recommendation')->nullable();
            $table->string('status')->default('done');
            $table->string('approval_status')->default('waiting');
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
        Schema::dropIfExists('test_reports');
    }
};
