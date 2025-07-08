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
        Schema::create('customer_driver_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('driver_id');
            $table->timestamp('assigned_at');
            $table->string('assigned_by')->nullable(); // Admin who made the assignment
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Add foreign key constraints
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->onDelete('cascade');
            
            // Add unique constraint to prevent duplicate assignments
            $table->unique(['customer_id', 'driver_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_driver_assignments');
    }
};
