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
        Schema::create('candidate_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('all_candidates')->onDelete('cascade');
            $table->enum('status', ['applied', 'interview_scheduled', 'interviewed', 'passed', 'rejected', 'hired'])->default('applied');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_statuses');
    }
};
