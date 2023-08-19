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
        Schema::table('test_reports', function (Blueprint $table) {
            $table->string('bnsp_certificate_number')->nullable()->after('bnsp_certificate');
            $table->date('bnsp_certificate_date')->nullable()->after('bnsp_certificate_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_reports', function (Blueprint $table) {
            $table->dropColumn('bnsp_certificate_number');
            $table->dropColumn('bnsp_certificate_date');
        });
    }
};
