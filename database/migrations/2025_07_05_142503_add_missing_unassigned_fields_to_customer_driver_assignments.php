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
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('customer_driver_assignments', 'unassigned_at')) {
                $table->timestamp('unassigned_at')->nullable();
            }
            if (!Schema::hasColumn('customer_driver_assignments', 'unassigned_by')) {
                $table->string('unassigned_by')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_driver_assignments', function (Blueprint $table) {
            if (Schema::hasColumn('customer_driver_assignments', 'unassigned_at')) {
                $table->dropColumn('unassigned_at');
            }
            if (Schema::hasColumn('customer_driver_assignments', 'unassigned_by')) {
                $table->dropColumn('unassigned_by');
            }
        });
    }
};
