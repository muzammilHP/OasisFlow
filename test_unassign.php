<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use App\Models\CustomerDriverAssignment;
use Illuminate\Support\Facades\Log;

// Test the unassign functionality
try {
    // Find an active assignment
    $assignment = CustomerDriverAssignment::where('status', 'active')->first();
    
    if (!$assignment) {
        echo "No active assignments found to test.\n";
        exit;
    }
    
    echo "Testing unassign functionality...\n";
    echo "Assignment ID: " . $assignment->id . "\n";
    echo "Customer ID: " . $assignment->customer_id . "\n";
    echo "Driver ID: " . $assignment->driver_id . "\n";
    echo "Current Status: " . $assignment->status . "\n";
    
    // Try to update the assignment
    $result = $assignment->update([
        'status' => 'inactive',
        'unassigned_at' => now(),
        'unassigned_by' => 'admin'
    ]);
    
    if ($result) {
        echo "SUCCESS: Assignment updated successfully!\n";
    } else {
        echo "FAILED: Could not update assignment\n";
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
