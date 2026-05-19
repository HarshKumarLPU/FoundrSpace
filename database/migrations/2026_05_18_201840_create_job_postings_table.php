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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startup_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('salary_range')->nullable();
            $table->string('type')->default('full-time'); // full-time, part-time, internship
            $table->string('status')->default('active'); // active, closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
