<?php

require_once 'vendor/autoload.php';

use App\Models\Driver;
use App\Models\Customer;
use App\Models\CustomerDriverAssignment;

$app = require_once 'bootstrap/app.php';

try {
    $driver = Driver::first();
    if ($driver) {
        echo "Driver found: " . $driver->name . " - Phone: " . ($driver->phone ?? 'null') . "\n";
    } else {
        echo "No drivers found\n";
    }
    
    $customer = Customer::first();
    if ($customer) {
        echo "Customer found: " . $customer->full_name . " - Address: " . ($customer->full_address ?? 'null') . "\n";
    } else {
        echo "No customers found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
