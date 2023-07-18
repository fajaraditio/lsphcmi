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
        Schema::create('test_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_schedule_id');
            $table->text('assessor_signature')->nullable();
            $table->dateTime('assessor_signed_at')->nullable();
            $table->text('participant_signature')->nullable();
            $table->dateTime('participant_signed_at')->nullable();
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
        Schema::dropIfExists('test_agreements');
    }
};
