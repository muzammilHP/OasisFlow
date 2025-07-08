<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\CustomerDriverAssignment;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // Fetch drivers data with statistics
        $drivers = Driver::all();
        $totalDrivers = $drivers->count();
        $activeDrivers = $drivers->where('status', 'active')->count();
        $onDeliveryDrivers = $drivers->where('status', 'on_delivery')->count();
        $avgRating = $drivers->avg('rating');
        
        // Fetch customers data with statistics
        $customers = Customer::all();
        $totalCustomers = $customers->count();
        $pendingCustomers = $customers->where('status', 'pending')->count();
        $deliveredCustomers = $customers->where('status', 'delivered')->count();
        $totalRevenue = $customers->sum('cash_amount');
        
        // Fetch completed deliveries data
        $completedDeliveries = CustomerDriverAssignment::with(['customer', 'driver'])
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        $totalCompletedDeliveries = $completedDeliveries->count();
        $todayCompletedDeliveries = $completedDeliveries->filter(function ($delivery) {
            return $delivery->updated_at->isToday();
        })->count();
        $thisWeekCompletedDeliveries = $completedDeliveries->filter(function ($delivery) {
            return $delivery->updated_at->isCurrentWeek();
        })->count();
        $thisMonthCompletedDeliveries = $completedDeliveries->filter(function ($delivery) {
            return $delivery->updated_at->isCurrentMonth();
        })->count();
        
        return view('Admin.admin-dashboard', compact(
            'drivers', 
            'totalDrivers', 
            'activeDrivers', 
            'onDeliveryDrivers', 
            'avgRating',
            'customers',
            'totalCustomers',
            'pendingCustomers',
            'deliveredCustomers',
            'totalRevenue',
            'completedDeliveries',
            'totalCompletedDeliveries',
            'todayCompletedDeliveries',
            'thisWeekCompletedDeliveries',
            'thisMonthCompletedDeliveries'
        ));
    }

    /**
     * Get delivery records for AJAX requests
     */
    public function getDeliveryRecords(Request $request)
    {
        try {
            $completedDeliveries = CustomerDriverAssignment::with(['customer', 'driver'])
                ->where('status', 'completed')
                ->orderBy('updated_at', 'desc')
                ->get();

            $data = [
                'completedDeliveries' => $completedDeliveries->map(function ($delivery) {
                    return [
                        'id' => $delivery->id,
                        'customer_id' => $delivery->customer->customer_id ?? 'N/A',
                        'customer_name' => $delivery->customer->full_name ?? 'N/A',
                        'phone' => $delivery->customer->mobile_number ?? 'N/A',
                        'address' => $delivery->customer->full_address ?? 'N/A',
                        'area' => $delivery->customer->area_name ?? 'N/A',
                        'driver_name' => $delivery->driver->name ?? 'N/A',
                        'bottles' => $delivery->customer->water_bottles ?? 0,
                        'cash_amount' => $delivery->customer->cash_amount ?? 0,
                        'completed_at' => $delivery->updated_at ? $delivery->updated_at->format('M d, Y h:i A') : 'N/A',
                        'notes' => $delivery->notes ?? 'No notes'
                    ];
                }),
                'stats' => [
                    'total' => $completedDeliveries->count(),
                    'today' => $completedDeliveries->filter(function ($delivery) {
                        return $delivery->updated_at->isToday();
                    })->count(),
                    'this_week' => $completedDeliveries->filter(function ($delivery) {
                        return $delivery->updated_at->isCurrentWeek();
                    })->count(),
                    'this_month' => $completedDeliveries->filter(function ($delivery) {
                        return $delivery->updated_at->isCurrentMonth();
                    })->count(),
                ]
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching delivery records: ' . $e->getMessage()
            ], 500);
        }
    }
}
