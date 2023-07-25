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
            $table->datetime('chief_approved_report_at')->nullable()->after('assessor_submitted_report_at');
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
            $table->dropColumn('chief_approved_report_at');
        });
    }
};
