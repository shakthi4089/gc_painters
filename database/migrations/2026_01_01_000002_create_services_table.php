<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->string('category')->default('General'); // Residential, Apartment, Commercial, Industrial, Interior, Exterior
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('cover_image')->nullable();
            $table->json('features')->nullable(); // List of key highlights/features
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
