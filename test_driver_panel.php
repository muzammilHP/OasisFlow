<?php

// Test script to verify driver panel functionality
require __DIR__ . '/vendor/autoload.php';

use App\Models\Driver;
use App\Models\Customer;
use App\Models\CustomerDriverAssignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Load Laravel configuration
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Driver Panel Functionality...\n\n";

try {
    // Check if we have a test driver
    $driver = Driver::where('driver_id', 'DRV001')->first();
    
    if (!$driver) {
        echo "Creating test driver...\n";
        $driver = Driver::create([
            'driver_id' => 'DRV001',
            'name' => 'Test Driver',
            'email' => 'driver@test.com',
            'password' => Hash::make('password123'),
            'phone' => '1234567890',
            'address' => '123 Test Street, Test City',
            'vehicle_number' => 'ABC123',
            'status' => 'active',
            'rating' => 4.5,
            'total_deliveries' => 0,
        ]);
        echo "Test driver created: {$driver->driver_id}\n";
    } else {
        echo "Test driver found: {$driver->driver_id}\n";
    }
    
    // Check if we have test customers
    $customers = Customer::limit(3)->get();
    
    if ($customers->count() < 3) {
        echo "Not enough test customers found. Creating test customers...\n";
        
        for ($i = 1; $i <= 3; $i++) {
            $customerId = 'CUS' . str_pad($i, 3, '0', STR_PAD_LEFT);
            
            if (!Customer::where('customer_id', $customerId)->exists()) {
                Customer::create([
                    'customer_id' => $customerId,
                    'full_name' => "Test Customer {$i}",
                    'mobile_number' => '987654321' . $i,
                    'email_address' => "customer{$i}@test.com",
                    'full_address' => "123 Customer Street {$i}, Test City",
                    'area_name' => "Test Area {$i}",
                    'delivery_day' => ['Monday', 'Tuesday', 'Wednesday'][$i - 1],
                    'delivery_time' => '10:00 AM',
                    'no_of_water_bottles_issued' => 5,
                    'pricing' => 60.00,
                    'payment_type' => 'cash',
                    'timestamp' => now(),
                ]);
                echo "Created test customer: {$customerId}\n";
            }
        }
        
        $customers = Customer::limit(3)->get();
    }
    
    // Create test assignments
    echo "\nCreating test assignments...\n";
    
    foreach ($customers as $customer) {
        $existingAssignment = CustomerDriverAssignment::where('customer_id', $customer->customer_id)
            ->where('driver_id', $driver->driver_id)
            ->where('status', 'active')
            ->first();
        
        if (!$existingAssignment) {
            CustomerDriverAssignment::create([
                'customer_id' => $customer->customer_id,
                'driver_id' => $driver->driver_id,
                'assigned_at' => now(),
                'assigned_by' => 'system',
                'status' => 'active',
                'notes' => 'Test assignment for ' . $customer->full_name,
            ]);
            echo "Created assignment for customer: {$customer->customer_id}\n";
        } else {
            echo "Assignment already exists for customer: {$customer->customer_id}\n";
        }
    }
    
    // Test driver statistics
    echo "\nTesting driver statistics...\n";
    
    $totalAssignments = CustomerDriverAssignment::where('driver_id', $driver->driver_id)->count();
    $activeAssignments = CustomerDriverAssignment::where('driver_id', $driver->driver_id)
        ->where('status', 'active')
        ->count();
    $completedDeliveries = CustomerDriverAssignment::where('driver_id', $driver->driver_id)
        ->where('status', 'completed')
        ->count();
    
    echo "Driver Statistics:\n";
    echo "- Total Assignments: {$totalAssignments}\n";
    echo "- Active Assignments: {$activeAssignments}\n";
    echo "- Completed Deliveries: {$completedDeliveries}\n";
    echo "- Driver Rating: {$driver->rating}\n";
    echo "- Total Deliveries: {$driver->total_deliveries}\n";
    
    // Test assigned deliveries query
    echo "\nTesting assigned deliveries query...\n";
    
    $assignments = CustomerDriverAssignment::with('customer')
        ->where('driver_id', $driver->driver_id)
        ->where('status', 'active')
        ->get();
    
    echo "Found {$assignments->count()} active assignments:\n";
    foreach ($assignments as $assignment) {
        echo "- {$assignment->customer->full_name} ({$assignment->customer->customer_id})\n";
        echo "  Address: {$assignment->customer->full_address}\n";
        echo "  Phone: {$assignment->customer->mobile_number}\n";
        echo "  Bottles: {$assignment->customer->no_of_water_bottles_issued}\n";
        echo "  Assigned: {$assignment->assigned_at}\n\n";
    }
    
    echo "Driver panel functionality test completed successfully!\n";
    echo "\nTest login credentials:\n";
    echo "Email: driver@test.com\n";
    echo "Password: password123\n\n";
    echo "You can now test the driver panel at: http://localhost:8000/driver-login\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
