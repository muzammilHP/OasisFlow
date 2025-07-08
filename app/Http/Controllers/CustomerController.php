<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\CustomerDriverAssignment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function customerPanel()
    {
        return view('main.customer-panel');
    }

    public function getCustomers()
    {
        try {
            $customers = Customer::orderBy('created_at', 'desc')->get();
            $drivers = Driver::where('status', 'active')->get();
            
            $totalCustomers = $customers->count();
            $pendingCustomers = $customers->where('status', 'pending')->count();
            $deliveredCustomers = $customers->where('status', 'delivered')->count();
            $totalRevenue = $customers->sum('price'); // Using price field for revenue calculation
            
            return response()->json([
                'success' => true,
                'customers' => $customers,
                'drivers' => $drivers,
                'stats' => [
                    'total' => $totalCustomers,
                    'pending' => $pendingCustomers,
                    'delivered' => $deliveredCustomers,
                    'revenue' => $totalRevenue,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch customers: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customers'
            ], 500);
        }
    }

    public function importCsv(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'excel_file' => 'required|mimes:csv|max:10240', // 10MB max
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file format. Please upload CSV file only.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $file = $request->file('excel_file');
            $importedCount = 0;
            $errors = [];

            // Handle CSV files
            $handle = fopen($file->getPathname(), 'r');
            $isFirstRow = true;
            
            while (($row = fgetcsv($handle)) !== false) {
                // Skip header row
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }
                
                try {
                    // Skip empty rows
                    if (empty(array_filter($row))) {
                        continue;
                    }

                    // Validate required fields
                    if (empty($row[3]) || empty($row[4])) {
                        $errors[] = "Row " . ($importedCount + 1) . ": Missing required fields (Customer ID or Full Name)";
                        continue;
                    }

                    // Parse and validate delivery time
                    $deliveryTime = null;
                    if (!empty($row[2]) && $row[2] !== '' && $row[2] !== 'Total') {
                        // Try to parse common time formats
                        if (preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', $row[2])) {
                            $deliveryTime = $row[2];
                        } elseif (preg_match('/(\d{1,2})\s*to\s*(\d{1,2})/', $row[2], $matches)) {
                            // Convert range like "7 to 12" to "07:00"
                            $deliveryTime = sprintf('%02d:00', $matches[1]);
                        } else {
                            // Skip invalid time formats
                            $deliveryTime = null;
                        }
                    }

                    // Parse numeric fields safely
                    $parseNumeric = function($value) {
                        if (empty($value) || $value === '?' || $value === '' || !is_numeric($value)) {
                            return null;
                        }
                        return $value;
                    };

                    $parseInt = function($value) {
                        if (empty($value) || $value === '?' || $value === '' || !is_numeric($value)) {
                            return null;
                        }
                        return (int) $value;
                    };

                    // Parse payment type to match enum values
                    $parsePaymentType = function($value) {
                        if (empty($value) || $value === '?') {
                            return null;
                        }
                        $validTypes = ['cash', 'card', 'online', 'bank_transfer'];
                        $normalized = strtolower(trim($value));
                        return in_array($normalized, $validTypes) ? $normalized : null;
                    };

                    // Parse string fields safely
                    $parseString = function($value) {
                        if (empty($value) || $value === '?' || $value === '') {
                            return null;
                        }
                        return $value;
                    };

                    // Parse timestamp safely
                    $timestamp = now(); // Default timestamp
                    if (!empty($row[0]) && $row[0] !== '' && $row[0] !== 'Total') {
                        try {
                            // Try to parse the timestamp
                            $parsedTimestamp = \Carbon\Carbon::parse($row[0]);
                            $timestamp = $parsedTimestamp;
                        } catch (\Exception $e) {
                            // If parsing fails, use current timestamp
                            $timestamp = now();
                        }
                    }

                    // Create customer record with all fields
                    Customer::create([
                        'timestamp' => $timestamp,
                        'delivery_day' => $parseString($row[1]),
                        'delivery_time' => $deliveryTime,
                        'customer_id' => $row[3] ?? '',
                        'full_name' => $row[4] ?? '',
                        'mobile_number' => $row[5] ?? '',
                        'alternative_mobile_number' => $parseString($row[6]),
                        'office_villa_flat_room_no' => $parseString($row[7]),
                        'street_name_building_name' => $parseString($row[8]),
                        'nearest_landmark' => $parseString($row[9]),
                        'area_name' => $parseString($row[10]),
                        'full_address' => $row[11] ?? '',
                        'geo_location_lat_long' => $parseString($row[12]),
                        'point_wkt' => $parseString($row[13]),
                        'google_map_location_link' => $parseString($row[14]),
                        'dmt_location_link' => $parseString($row[15]),
                        'lat' => $parseNumeric($row[16]),
                        'long' => $parseNumeric($row[17]),
                        'plus_code' => $parseString($row[18]),
                        'no_of_water_bottles_issued' => $parseInt($row[19]),
                        'of_bottles_returned' => $parseInt($row[20]),
                        'of_bottles_cash_received' => $parseInt($row[21]),
                        'no_of_water_despenser_issued' => $parseInt($row[22]),
                        'no_of_water_despenser_sold' => $parseInt($row[23]),
                        'water_despenser_model_number' => $parseString($row[24]),
                        'water_despense_condition' => $parseString($row[25]),
                        'security_deposit' => $parseNumeric($row[26]),
                        'select_product' => $parseString($row[27]),
                        'coupon_book_serial_number' => $parseString($row[28]),
                        'payment_type' => $parsePaymentType($row[29]),
                        'price' => $parseNumeric($row[30]),
                        'pricing' => $parseNumeric($row[31]),
                        'how_you_heard_about_us' => $parseString($row[32]),
                        'remarks' => $parseString($row[33]),
                        'email_address' => $parseString($row[34]),
                        'water_despenser_picture' => $parseString($row[35]),
                        'customer_registration_form' => $parseString($row[36]),
                        'customer_emirates_id_front' => $parseString($row[37]),
                        'customer_emirates_id_back' => $parseString($row[38]),
                        'company_trade_mark' => $parseString($row[39]),
                        'status' => 'pending',
                    ]);

                    $importedCount++;
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($importedCount + 1) . ": " . $e->getMessage();
                }
            }
            fclose($handle);

            return response()->json([
                'success' => true,
                'message' => "Successfully imported {$importedCount} customers",
                'imported_count' => $importedCount,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            Log::error('CSV import failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to import file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createCustomer(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|string|max:255|unique:customers,customer_id',
                'full_name' => 'required|string|max:255',
                'mobile_number' => 'required|string|max:20',
                'full_address' => 'required|string',
                'alternative_mobile_number' => 'nullable|string|max:20',
                'office_villa_flat_room_no' => 'nullable|string|max:255',
                'street_name_building_name' => 'nullable|string|max:255',
                'nearest_landmark' => 'nullable|string|max:255',
                'area_name' => 'nullable|string|max:255',
                'delivery_day' => 'nullable|string|max:50',
                'delivery_time' => 'nullable|date_format:H:i',
                'lat' => 'nullable|numeric|between:-90,90',
                'long' => 'nullable|numeric|between:-180,180',
                'email_address' => 'nullable|email|max:255',
                'payment_type' => 'nullable|in:cash,card,online,bank_transfer',
                'pricing' => 'nullable|numeric|min:0',
                'price' => 'nullable|numeric|min:0',
                'security_deposit' => 'nullable|numeric|min:0',
                'no_of_water_bottles_issued' => 'nullable|integer|min:0',
                'of_bottles_returned' => 'nullable|integer|min:0',
                'of_bottles_cash_received' => 'nullable|integer|min:0',
                'no_of_water_despenser_issued' => 'nullable|integer|min:0',
                'no_of_water_despenser_sold' => 'nullable|integer|min:0',
                'water_despenser_model_number' => 'nullable|string|max:255',
                'water_despense_condition' => 'nullable|string|max:255',
                'select_product' => 'nullable|string|max:255',
                'coupon_book_serial_number' => 'nullable|string|max:255',
                'how_you_heard_about_us' => 'nullable|string|max:255',
                'remarks' => 'nullable|string',
                'geo_location_lat_long' => 'nullable|string|max:255',
                'point_wkt' => 'nullable|string',
                'google_map_location_link' => 'nullable|url',
                'dmt_location_link' => 'nullable|url',
                'plus_code' => 'nullable|string|max:255',
                'water_despenser_picture' => 'nullable|string|max:255',
                'customer_registration_form' => 'nullable|string|max:255',
                'customer_emirates_id_front' => 'nullable|string|max:255',
                'customer_emirates_id_back' => 'nullable|string|max:255',
                'company_trade_mark' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $customer = Customer::create([
                'timestamp' => now(),
                'customer_id' => $request->customer_id,
                'full_name' => $request->full_name,
                'mobile_number' => $request->mobile_number,
                'full_address' => $request->full_address,
                'alternative_mobile_number' => $request->alternative_mobile_number,
                'office_villa_flat_room_no' => $request->office_villa_flat_room_no,
                'street_name_building_name' => $request->street_name_building_name,
                'nearest_landmark' => $request->nearest_landmark,
                'area_name' => $request->area_name,
                'delivery_day' => $request->delivery_day,
                'delivery_time' => $request->delivery_time,
                'lat' => $request->lat,
                'long' => $request->long,
                'email_address' => $request->email_address,
                'payment_type' => $request->payment_type,
                'pricing' => $request->pricing,
                'price' => $request->price,
                'security_deposit' => $request->security_deposit,
                'no_of_water_bottles_issued' => $request->no_of_water_bottles_issued,
                'of_bottles_returned' => $request->of_bottles_returned,
                'of_bottles_cash_received' => $request->of_bottles_cash_received,
                'no_of_water_despenser_issued' => $request->no_of_water_despenser_issued,
                'no_of_water_despenser_sold' => $request->no_of_water_despenser_sold,
                'water_despenser_model_number' => $request->water_despenser_model_number,
                'water_despense_condition' => $request->water_despense_condition,
                'select_product' => $request->select_product,
                'coupon_book_serial_number' => $request->coupon_book_serial_number,
                'how_you_heard_about_us' => $request->how_you_heard_about_us,
                'remarks' => $request->remarks,
                'geo_location_lat_long' => $request->geo_location_lat_long,
                'point_wkt' => $request->point_wkt,
                'google_map_location_link' => $request->google_map_location_link,
                'dmt_location_link' => $request->dmt_location_link,
                'plus_code' => $request->plus_code,
                'water_despenser_picture' => $request->water_despenser_picture,
                'customer_registration_form' => $request->customer_registration_form,
                'customer_emirates_id_front' => $request->customer_emirates_id_front,
                'customer_emirates_id_back' => $request->customer_emirates_id_back,
                'company_trade_mark' => $request->company_trade_mark,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'customer' => $customer
            ], 201);

        } catch (\Exception $e) {
            Log::error('Customer creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create customer'
            ], 500);
        }
    }

    public function editCustomer($customer_id)
    {
        try {
            $customer = Customer::where('customer_id', $customer_id)->first();
            
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'customer' => $customer
            ]);
        } catch (\Exception $e) {
            Log::error('Customer edit failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customer details'
            ], 500);
        }
    }

    public function updateCustomer(Request $request, $customer_id)
    {
        try {
            $customer = Customer::where('customer_id', $customer_id)->first();
            
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'mobile_number' => 'required|string|max:20',
                'full_address' => 'nullable|string',
                'status' => 'required|in:pending,delivered,cancelled',
                'alternative_mobile_number' => 'nullable|string|max:20',
                'office_villa_flat_room_no' => 'nullable|string|max:255',
                'street_name_building_name' => 'nullable|string|max:255',
                'nearest_landmark' => 'nullable|string|max:255',
                'area_name' => 'nullable|string|max:255',
                'delivery_day' => 'nullable|string|max:50',
                'delivery_time' => 'nullable|string|max:50',
                'lat' => 'nullable|numeric|between:-90,90',
                'long' => 'nullable|numeric|between:-180,180',
                'email_address' => 'nullable|email|max:255',
                'payment_type' => 'nullable|string|max:50',
                'pricing' => 'nullable|numeric|min:0',
                'price' => 'nullable|numeric|min:0',
                'security_deposit' => 'nullable|numeric|min:0',
                'no_of_water_bottles_issued' => 'nullable|integer|min:0',
                'of_bottles_returned' => 'nullable|integer|min:0',
                'of_bottles_cash_received' => 'nullable|integer|min:0',
                'no_of_water_despenser_issued' => 'nullable|integer|min:0',
                'no_of_water_despenser_sold' => 'nullable|integer|min:0',
                'water_despenser_model_number' => 'nullable|string|max:255',
                'water_despense_condition' => 'nullable|string|max:255',
                'select_product' => 'nullable|string|max:255',
                'coupon_book_serial_number' => 'nullable|string|max:255',
                'how_you_heard_about_us' => 'nullable|string|max:255',
                'remarks' => 'nullable|string',
                'google_map_location_link' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $customer->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully',
                'customer' => $customer
            ]);

        } catch (\Exception $e) {
            Log::error('Customer update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update customer'
            ], 500);
        }
    }

    public function deleteCustomer($customer_id)
    {
        try {
            $customer = Customer::where('customer_id', $customer_id)->first();
            
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            $customer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Customer deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete customer'
            ], 500);
        }
    }

    public function assignCustomerToDriver(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customer_ids' => 'required|array',
                'customer_ids.*' => 'exists:customers,customer_id',
                'driver_id' => 'required|exists:drivers,driver_id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $driver = Driver::where('driver_id', $request->driver_id)->first();
            $customers = Customer::whereIn('customer_id', $request->customer_ids)->get();
            
            $assignedCount = 0;
            $errors = [];

            foreach ($request->customer_ids as $customerId) {
                try {
                    // Check if customer is already assigned to ANY driver with active status
                    $existingAssignment = CustomerDriverAssignment::where('customer_id', $customerId)
                        ->where('status', 'active')
                        ->first();
                    
                    if ($existingAssignment) {
                        $existingDriver = Driver::where('driver_id', $existingAssignment->driver_id)->first();
                        $driverName = $existingDriver ? $existingDriver->name : 'Unknown Driver';
                        $errors[] = "Customer {$customerId} is already assigned to {$driverName}";
                        continue;
                    }
                    
                    // Create new assignment
                    CustomerDriverAssignment::create([
                        'customer_id' => $customerId,
                        'driver_id' => $request->driver_id,
                        'assigned_at' => now(),
                        'assigned_by' => 'admin', // You can update this to use actual admin user
                        'status' => 'active',
                        'notes' => 'Assigned via admin dashboard'
                    ]);
                    
                    $assignedCount++;
                } catch (\Exception $e) {
                    $errors[] = "Failed to assign customer {$customerId}: " . $e->getMessage();
                }
            }

            $message = $assignedCount > 0 
                ? "{$assignedCount} customers assigned to {$driver->name}" 
                : "No customers were assigned";
            
            if (!empty($errors)) {
                $message .= ". Some assignments failed: " . implode(", ", $errors);
            }

            return response()->json([
                'success' => $assignedCount > 0,
                'message' => $message,
                'assigned_count' => $assignedCount,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            Log::error('Customer assignment failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign customers'
            ], 500);
        }
    }

    public function downloadTemplate()
    {
        try {
            // Create CSV template with all required fields
            $csvData = [
                [
                    'Timestamp', 'Delivery Day', 'Delivery Time', 'Customer ID', 'Full Name', 'Mobile Number',
                    'Alternative Mobile Number', 'Office No/Villa No/Flat No/Room No', 'Street Name/Building Name',
                    'Nearest Landmark', 'Area Name', 'Full Address', 'Geo Location(Lat,Long)', 'Point WKT',
                    'Google Map Location Link', 'DMT Location Link', 'Lat', 'Long', 'Plus Code',
                    'No of water bottles issued', 'Of Bottles t Returned', 'Of Bottles cash Received',
                    'No of water despenser issued', 'No of Water despenser sold', 'Water Despenser model number',
                    'Water despense condition', 'Security Deposit', 'select product', 'Coupon book serial number',
                    'Payment type', 'price', 'Pricing', 'How you heard about us?', 'Remarks', 'Email Address',
                    'Water Despenser Picture', 'Customer Registration Form', 'Customer Emirates ID Front',
                    'Customer Emirates ID Back', 'Company Trade Mark'
                ],
                [
                    '2025-07-05 10:00:00', 'Monday', '14:30', 'CUS001', 'Ahmed Hassan', '971501234567',
                    '971521234567', 'Villa 123', 'Al Khalidiyah Street', 'Near Mall', 'Al Khalidiyah',
                    'Villa 123, Al Khalidiyah Street, Al Khalidiyah, Abu Dhabi', '24.4539,54.3773', 'POINT (54.3773 24.4539)',
                    'https://maps.google.com/...', 'https://dmt.ae/...', '24.4539', '54.3773', '7GQR9P3F+XX',
                    '5', '2', '3', '1', '0', 'Model-X1', 'Good', '200.00', 'Water Bottles',
                    'CB001', 'cash', '12.00', '60.00', 'Social Media', 'Regular customer', 'ahmed@email.com',
                    'dispenser_pic.jpg', 'registration_form.pdf', 'emirates_id_front.jpg',
                    'emirates_id_back.jpg', 'trade_mark.jpg'
                ]
            ];

            $filename = 'customers_template.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            $callback = function() use ($csvData) {
                $file = fopen('php://output', 'w');
                foreach ($csvData as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Template download failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to download template'
            ], 500);
        }
    }

    public function getCustomerAssignments()
    {
        try {
            $assignments = CustomerDriverAssignment::with(['customer', 'driver'])
                ->where('status', 'active')
                ->orderBy('assigned_at', 'desc')
                ->get();
            
            // Group assignments by driver
            $assignmentsByDriver = $assignments->groupBy('driver_id')->map(function ($driverAssignments) {
                $driver = $driverAssignments->first()->driver;
                return [
                    'driver' => [
                        'driver_id' => $driver->driver_id,
                        'name' => $driver->name,
                        'mobile_number' => $driver->phone ?? 'undefined',
                        'status' => $driver->status,
                    ],
                    'customers' => $driverAssignments->map(function ($assignment) {
                        return [
                            'customer_id' => $assignment->customer->customer_id,
                            'full_name' => $assignment->customer->full_name,
                            'mobile_number' => $assignment->customer->mobile_number,
                            'full_address' => $assignment->customer->full_address,
                            'area_name' => $assignment->customer->area_name,
                            'assigned_at' => $assignment->assigned_at ? $assignment->assigned_at->format('Y-m-d H:i:s') : 'Invalid Date',
                            'assigned_by' => $assignment->assigned_by,
                            'status' => $assignment->status,
                        ];
                    }),
                    'assignment_count' => $driverAssignments->count()
                ];
            });
            
            return response()->json([
                'success' => true,
                'assignments' => $assignmentsByDriver->values(),
                'total_assignments' => $assignments->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch customer assignments: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch assignments'
            ], 500);
        }
    }

    public function unassignCustomer($customer_id)
    {
        try {
            $assignment = CustomerDriverAssignment::where('customer_id', $customer_id)
                ->where('status', 'active')
                ->first();
            
            if (!$assignment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assignment not found or already inactive'
                ], 404);
            }
            
            // Check if there's already an inactive record for this customer-driver combination
            $existingInactive = CustomerDriverAssignment::where('customer_id', $customer_id)
                ->where('driver_id', $assignment->driver_id)
                ->where('status', 'inactive')
                ->first();
            
            if ($existingInactive) {
                // If there's an existing inactive record, delete it first
                $existingInactive->delete();
            }
            
            $assignment->update([
                'status' => 'inactive',
                'unassigned_at' => now(),
                'unassigned_by' => 'admin'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Customer unassigned successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to unassign customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to unassign customer'
            ], 500);
        }
    }
}
