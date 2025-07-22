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
        Schema::create('hackathons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('date');
            $table->string('image');
            $table->boolean('is_published');
            $table->string('font_style');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hackathons');
    }
};
