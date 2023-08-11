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
        Schema::create('scoring_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('scoring_component_id')->nullable();
            $table->text('title')->nullable();
            $table->integer('score')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoring_criterias');
    }
};
