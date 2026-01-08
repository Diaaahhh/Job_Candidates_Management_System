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
        Schema::table('all_candidates', function (Blueprint $table) {
            $table->enum('current_status', ['applied', 'interview_scheduled', 'interviewed', 'passed', 'rejected', 'hired'])->default('applied')->after('age');
            $table->timestamp('hired_at')->nullable()->after('current_status');
            $table->timestamp('rejected_at')->nullable()->after('hired_at');
            $table->text('rejection_reason')->nullable()->after('rejected_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_candidates', function (Blueprint $table) {
            $table->dropColumn(['current_status', 'hired_at', 'rejected_at', 'rejection_reason']);
        });
    }
};
