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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheme_id');
            $table->string('bib_number')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('identity_number')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('home_phone_number')->nullable();
            $table->string('office_phone_number')->nullable();
            $table->string('cell_phone_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('position_at_work')->nullable();
            $table->text('company_address')->nullable();
            $table->text('company_city')->nullable();
            $table->integer('company_zip_code')->nullable();
            $table->string('company_phone_number')->nullable();
            $table->string('company_fax_number')->nullable();
            $table->string('company_cell_phone_number')->nullable();
            $table->string('payment_receipt')->nullable();
            $table->string('assessment_purpose')->nullable();
            $table->string('status')->default('unpaid')->nullable();
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
        Schema::dropIfExists('participants');
    }
};
