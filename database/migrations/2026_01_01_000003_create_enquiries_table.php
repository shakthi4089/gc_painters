<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('property_type'); // House, Apartment, Commercial, Industrial
            $table->string('location');
            $table->string('painting_type'); // Interior, Exterior, Both
            $table->string('approx_area')->nullable(); // e.g. 2500 sq.ft
            $table->string('floors')->nullable(); // e.g. 2 Floors / G+2
            $table->date('preferred_start_date')->nullable();
            $table->json('photos')->nullable(); // Array of uploaded photo paths
            $table->text('additional_requirements')->nullable();
            $table->string('status')->default('New'); // New, Contacted, Site Visit, Converted, Rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
