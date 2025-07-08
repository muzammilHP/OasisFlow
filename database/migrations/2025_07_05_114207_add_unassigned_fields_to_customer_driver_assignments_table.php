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
        Schema::table('customer_driver_assignments', function (Blueprint $table) {
            $table->timestamp('unassigned_at')->nullable();
            $table->string('unassigned_by')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled', 'inactive'])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_driver_assignments', function (Blueprint $table) {
            $table->dropColumn(['unassigned_at', 'unassigned_by']);
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active')->change();
        });
    }
};
