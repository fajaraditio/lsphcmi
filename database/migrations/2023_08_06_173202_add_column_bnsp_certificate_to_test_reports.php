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
            $table->string('bnsp_certificate')->nullable()->after('aspect_notes');
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
            $table->dropColumn('bnsp_certificate');
        });
    }
};
