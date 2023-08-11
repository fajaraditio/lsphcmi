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
        Schema::dropIfExists('self_assessment_score_criterias');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('self_assessment_score_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('self_assessment_score_component_id')->nullable();
            $table->text('title')->nullable();
            $table->integer('score')->default(1);
        });
    }
};
