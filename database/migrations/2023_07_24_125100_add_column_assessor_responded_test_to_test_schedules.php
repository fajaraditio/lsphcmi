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
        Schema::table('test_schedules', function (Blueprint $table) {
            $table->datetime('assessor_reviewed_test_practice_at')->nullable()->after('assessor_submitted_test_practice_at');
            $table->datetime('assessor_reviewed_test_observation_at')->nullable()->after('assessor_submitted_test_observation_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_schedules', function (Blueprint $table) {
            $table->dropColumn('assessor_reviewed_test_practice_at');
            $table->dropColumn('assessor_reviewed_test_observation_at');
        });
    }
};
