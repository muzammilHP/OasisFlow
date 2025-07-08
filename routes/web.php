<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\CustomerDriverAssignment;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'homepage'])->name('homepage');

Route::controller(AuthController::class)->group(function(){
    Route::get('customer-signup', 'customerSignup')->name('customer.signup');
    Route::post('customer-store', 'customerStore')->name('customer.store');
    Route::get('customer-login', 'customerLogin')->name('customer.login');
    Route::post('customer-authenticate', 'customerAuthenticate')->name('customer.authenticate');
    Route::get('check-customeremail', 'checkcustomerEmail')->name('check.customer.email');

    Route::get('driver-signup', 'driverSignup')->name('driver.signup');
    Route::post('driver-store', 'driverStore')->name('driver.store');
    Route::get('driver-login', 'driverLogin')->name('driver.login');
    Route::post('driver-authenticate', 'driverAuthenticate')->name('driver.authenticate');
    Route::get('check-driveremail', 'checkdriverEmail')->name('check.driver.email');

});


Route::middleware('auth.customer')->group(function () {
    Route::get('customerpanel', [CustomerController::class, 'customerPanel'])->name('customer.panel');
    // Add more customer-only routes here
});

// Driver dashboard
Route::middleware('auth.driver')->group(function () {
    Route::get('driverpanel', [DriverController::class, 'driverPanel'])->name('driver.panel');
    
    // Driver API endpoints
    Route::prefix('driver')->group(function () {
        Route::get('profile', [DriverController::class, 'getProfile'])->name('driver.profile');
        Route::get('assigned-deliveries', [DriverController::class, 'getAssignedDeliveries'])->name('driver.assigned.deliveries');
        Route::get('stats', [DriverController::class, 'getStats'])->name('driver.stats');
        Route::get('delivery-history', [DriverController::class, 'getDeliveryHistory'])->name('driver.delivery.history');
        Route::post('complete-delivery', [DriverController::class, 'completeDelivery'])->name('driver.complete.delivery');
        Route::post('logout', [DriverController::class, 'logout'])->name('driver.logout');
    });
});

Route::get('/verify-customer-email/{token}', function ($token) {
    // Find the customer with the provided token
    $customer = Customer::where('email_verification_token', $token)->first();

    if ($customer) {
        // Mark the customer's email as verified
        $customer->email_verified_at = now();
        $customer->email_verification_token = null; // Clear the token after verification
        $customer->save();

        return redirect()->route('customer.login')->with('success', 'Your email has been verified successfully!');
    }

    return redirect()->route('customer.login')->with('error', 'Invalid or expired verification link.');
})->name('verify.customerEmail');

Route::get('/verify-driver-email/{token}', function ($token) {
    // Find the customer with the provided token
    $driver = Driver::where('email_verification_token', $token)->first();

    if ($driver) {
        // Mark the customer's email as verified
        $driver->email_verified_at = now();
        $driver->email_verification_token = null; // Clear the token after verification
        $driver->save();

        return redirect()->route('driver.login')->with('success', 'Your email has been verified successfully!');
    }

    return redirect()->route('driver.login')->with('error', 'Invalid or expired verification link.');
})->name('verify.driverEmail');


Route::get('/admin-login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin-authenticate', [AuthController::class, 'adminAuthenticate'])->name('admin.authenticate');
Route::post('/admin-logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('auth.admin');

// Admin routes for driver management
Route::middleware('auth.admin')->group(function () {
    Route::post('/admin/drivers/create', [DriverController::class, 'createDriver'])->name('admin.drivers.create');
    Route::get('/admin/drivers/{driver_id}/edit', [DriverController::class, 'editDriver'])->name('admin.drivers.edit');
    Route::put('/admin/drivers/{driver_id}', [DriverController::class, 'updateDriver'])->name('admin.drivers.update');
    Route::delete('/admin/drivers/{driver_id}', [DriverController::class, 'deleteDriver'])->name('admin.drivers.delete');
    
    // Customer management routes
    Route::get('/admin/customers', [CustomerController::class, 'getCustomers'])->name('admin.customers.get');
    Route::post('/admin/customers/import', [CustomerController::class, 'importCsv'])->name('admin.customers.import');
    Route::post('/admin/customers/create', [CustomerController::class, 'createCustomer'])->name('admin.customers.create');
    Route::get('/admin/customers/{customer_id}/edit', [CustomerController::class, 'editCustomer'])->name('admin.customers.edit');
    Route::put('/admin/customers/{customer_id}', [CustomerController::class, 'updateCustomer'])->name('admin.customers.update');
    Route::delete('/admin/customers/{customer_id}', [CustomerController::class, 'deleteCustomer'])->name('admin.customers.delete');
    Route::post('/admin/customers/assign', [CustomerController::class, 'assignCustomerToDriver'])->name('admin.customers.assign');
    Route::get('/admin/customer-assignments', [CustomerController::class, 'getCustomerAssignments'])->name('admin.customers.assignments');
    Route::delete('/admin/customer-assignments/{customer_id}', [CustomerController::class, 'unassignCustomer'])->name('admin.customers.unassign');
    Route::get('/admin/customers/template', [CustomerController::class, 'downloadTemplate'])->name('admin.customers.template');
    
    // Delivery records route
    Route::get('/admin/delivery-records', [AdminController::class, 'getDeliveryRecords'])->name('admin.delivery.records');
    
    Route::get('/admin/test', function() {
        return response()->json(['message' => 'Admin middleware is working']);
    });
});
