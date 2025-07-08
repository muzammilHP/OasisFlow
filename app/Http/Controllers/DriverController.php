<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\CustomerDriverAssignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    public function driverPanel()
    {
        return view('main.driver-panel');
    }

    /**
     * Get driver profile information
     */
    public function getProfile(Request $request)
    {
        try {
            $driver = auth('driver')->user();
            
            return response()->json([
                'success' => true,
                'driver' => [
                    'id' => $driver->driver_id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                    'phone' => $driver->phone,
                    'address' => $driver->address,
                    'vehicle_number' => $driver->vehicle_number,
                    'status' => $driver->status,
                    'total_deliveries' => $driver->total_deliveries ?? 0,
                    'rating' => $driver->rating ?? 0.0,
                    'last_login_at' => $driver->last_login_at,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching driver profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get assigned deliveries for the logged-in driver
     */
    public function getAssignedDeliveries(Request $request)
    {
        try {
            $driver = auth('driver')->user();
            
            $assignments = CustomerDriverAssignment::with('customer')
                ->where('driver_id', $driver->driver_id)
                ->where('status', 'active')
                ->get();
            
            $deliveries = $assignments->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'customer_id' => $assignment->customer_id,
                    'customer_name' => $assignment->customer->full_name,
                    'customer_phone' => $assignment->customer->mobile_number,
                    'customer_address' => $assignment->customer->full_address,
                    'area_name' => $assignment->customer->area_name,
                    'delivery_day' => $assignment->customer->delivery_day,
                    'delivery_time' => $assignment->customer->delivery_time,
                    'bottles_required' => $assignment->customer->no_of_water_bottles_issued,
                    'assigned_at' => $assignment->assigned_at,
                    'status' => $assignment->status,
                    'notes' => $assignment->notes,
                    'google_map_link' => $assignment->customer->google_map_location_link,
                ];
            });
            
            return response()->json([
                'success' => true,
                'deliveries' => $deliveries
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching assigned deliveries: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get driver statistics
     */
    public function getStats(Request $request)
    {
        try {
            $driver = auth('driver')->user();
            
            $totalAssignments = CustomerDriverAssignment::where('driver_id', $driver->driver_id)->count();
            $activeAssignments = CustomerDriverAssignment::where('driver_id', $driver->driver_id)
                ->where('status', 'active')
                ->count();
            $completedDeliveries = CustomerDriverAssignment::where('driver_id', $driver->driver_id)
                ->where('status', 'completed')
                ->count();
            
            // Get this month's stats
            $thisMonth = now()->startOfMonth();
            $thisMonthAssignments = CustomerDriverAssignment::where('driver_id', $driver->driver_id)
                ->where('assigned_at', '>=', $thisMonth)
                ->count();
            
            return response()->json([
                'success' => true,
                'stats' => [
                    'total_assignments' => $totalAssignments,
                    'active_assignments' => $activeAssignments,
                    'completed_deliveries' => $completedDeliveries,
                    'this_month_assignments' => $thisMonthAssignments,
                    'driver_rating' => $driver->rating ?? 0.0,
                    'total_deliveries' => $driver->total_deliveries ?? 0,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching driver stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get delivery history for the logged-in driver
     */
    public function getDeliveryHistory(Request $request)
    {
        try {
            $driver = auth('driver')->user();
            
            $history = CustomerDriverAssignment::with('customer')
                ->where('driver_id', $driver->driver_id)
                ->whereIn('status', ['completed', 'cancelled'])
                ->orderBy('updated_at', 'desc')
                ->get();
            
            $deliveryHistory = $history->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'customer_id' => $assignment->customer_id,
                    'customer_name' => $assignment->customer->full_name,
                    'customer_phone' => $assignment->customer->mobile_number,
                    'customer_address' => $assignment->customer->full_address,
                    'area_name' => $assignment->customer->area_name,
                    'assigned_at' => $assignment->assigned_at,
                    'completed_at' => $assignment->updated_at,
                    'status' => $assignment->status,
                    'notes' => $assignment->notes,
                    'bottles_delivered' => $assignment->customer->no_of_water_bottles_issued,
                ];
            });
            
            return response()->json([
                'success' => true,
                'history' => $deliveryHistory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching delivery history: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark a delivery as completed
     */
    public function completeDelivery(Request $request)
    {
        try {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'assignment_id' => 'required|integer|exists:customer_driver_assignments,id',
                'notes' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $driver = auth('driver')->user();
            
            $assignment = CustomerDriverAssignment::where('id', $request->assignment_id)
                ->where('driver_id', $driver->driver_id)
                ->where('status', 'active')
                ->first();

            if (!$assignment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assignment not found or already completed'
                ], 404);
            }

            $assignment->status = 'completed';
            $assignment->notes = $request->notes;
            $assignment->save();

            // Update driver's total deliveries
            $driver->total_deliveries = ($driver->total_deliveries ?? 0) + 1;
            $driver->save();

            return response()->json([
                'success' => true,
                'message' => 'Delivery marked as completed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error completing delivery: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Driver logout
     */
    public function logout(Request $request)
    {
        try {
            $driver = auth('driver')->user();
            
            // Update last login timestamp
            $driver->last_login_at = now();
            $driver->save();
            
            auth('driver')->logout();
            
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error logging out: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createDriver(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:drivers',
                'phone' => 'required|string|max:20|unique:drivers',
                'address' => 'required|string',
                'driver_id' => 'required|string|unique:drivers|regex:/^DRV\d{3}$/',
                'password' => 'required|string|min:8',
                'vehicle_number' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create new driver
            $driver = Driver::create([
                'driver_id' => $request->driver_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'vehicle_number' => $request->vehicle_number,
                'status' => 'active',
                'rating' => 0.00,
                'total_deliveries' => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Driver created successfully',
                'driver' => [
                    'id' => $driver->id,
                    'driver_id' => $driver->driver_id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                    'phone' => $driver->phone,
                    'vehicle_number' => $driver->vehicle_number,
                    'status' => $driver->status,
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Driver creation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create driver account. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editDriver($driver_id)
    {
        try {
            $driver = Driver::where('driver_id', $driver_id)->first();
            
            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'driver' => [
                    'id' => $driver->id,
                    'driver_id' => $driver->driver_id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                    'phone' => $driver->phone,
                    'address' => $driver->address,
                    'vehicle_number' => $driver->vehicle_number,
                    'status' => $driver->status,
                    'rating' => $driver->rating,
                    'total_deliveries' => $driver->total_deliveries,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Driver edit failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch driver details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDriver(Request $request, $driver_id)
    {
        try {
            $driver = Driver::where('driver_id', $driver_id)->first();
            
            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:drivers,email,' . $driver->id,
                'phone' => 'required|string|max:20|unique:drivers,phone,' . $driver->id,
                'address' => 'required|string',
                'vehicle_number' => 'nullable|string',
                'status' => 'required|in:active,inactive,on_delivery',
                'password' => 'nullable|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Prepare update data
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'vehicle_number' => $request->vehicle_number,
                'status' => $request->status,
            ];

            // Update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update driver
            $driver->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Driver updated successfully',
                'driver' => [
                    'id' => $driver->id,
                    'driver_id' => $driver->driver_id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                    'phone' => $driver->phone,
                    'vehicle_number' => $driver->vehicle_number,
                    'status' => $driver->status,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Driver update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update driver',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteDriver($driver_id)
    {
        try {
            $driver = Driver::where('driver_id', $driver_id)->first();
            
            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            // Store driver name for response
            $driverName = $driver->name;
            
            // Delete the driver
            $driver->delete();

            return response()->json([
                'success' => true,
                'message' => "Driver '{$driverName}' has been successfully deleted"
            ]);

        } catch (\Exception $e) {
            Log::error('Driver deletion failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete driver',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
