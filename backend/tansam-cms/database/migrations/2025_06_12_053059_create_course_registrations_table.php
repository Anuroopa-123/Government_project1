<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('address_line_one');
            $table->string('address_line_two');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('college_organization');
            $table->string('department_domain');
            $table->string('year_experience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};
