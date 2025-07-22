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
        Schema::create('entrepreneurships', function (Blueprint $table) {
            $table->id();
            $table->string('course_title');
            $table->string('course_lab');
            $table->string('course_image');
            $table->date('start_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('mode');
            $table->string('contact_person');
            $table->string('contact_mail');
            $table->boolean('is_published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneurships');
    }
};
