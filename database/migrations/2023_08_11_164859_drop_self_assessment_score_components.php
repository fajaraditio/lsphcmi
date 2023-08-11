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
        Schema::dropIfExists('self_assessment_score_components');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('self_assessment_score_components', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->float('weight')->default(1);
        });
    }
};
