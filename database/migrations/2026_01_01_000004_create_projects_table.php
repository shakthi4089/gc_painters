<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('property_type'); // House, Apartment, Commercial, Industrial
            $table->string('painting_type')->default('Exterior'); // Interior, Exterior, Both
            $table->string('location'); // e.g. Chennai, Avadi, Ambattur
            $table->string('area_sqft')->nullable(); // e.g. 25,000 sq.ft
            $table->string('year_completed')->nullable(); // e.g. 2026
            $table->string('work_details')->nullable(); // e.g. Exterior Weather Proofing & Texture Painting
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->date('completed_date')->nullable();
            // Status: Enquiry -> Site Visit -> Quotation -> Approved -> In Progress -> Completed
            $table->string('status')->default('In Progress');
            $table->integer('progress_percent')->default(0); // 0 to 100
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->decimal('paid_amount', 12, 2)->default(0.00);
            $table->string('cover_image')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('show_before_after')->default(true);
            $table->string('team_supervisor')->nullable();
            $table->text('materials_used')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
