<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// Check the columns in the customer_driver_assignments table
$columns = Schema::getColumnListing('customer_driver_assignments');
echo "Columns in customer_driver_assignments table:\n";
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\nActual table structure:\n";
$result = DB::select('DESCRIBE customer_driver_assignments');
foreach ($result as $row) {
    echo "- {$row->Field} ({$row->Type})\n";
}
