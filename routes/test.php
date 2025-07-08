<?php

use Illuminate\Support\Facades\Route;
use App\Models\CustomerDriverAssignment;

// Test route for unassign functionality
Route::get('/test-unassign', function () {
    try {
        // Find an active assignment
        $assignment = CustomerDriverAssignment::where('status', 'active')->first();
        
        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'No active assignments found to test'
            ]);
        }
        
        // Test the unassign functionality
        $result = $assignment->update([
            'status' => 'inactive',
            'unassigned_at' => now(),
            'unassigned_by' => 'admin'
        ]);
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Assignment unassigned successfully',
                'assignment' => $assignment->fresh()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update assignment'
            ]);
        }
        
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
});
