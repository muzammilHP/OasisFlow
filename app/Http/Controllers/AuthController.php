<?php

namespace App\Http\Controllers;
use App\Http\Middleware\customerMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Admin;
use App\Mail\customerLoggedInMail;
use App\Mail\driverLoggedInMail;
use App\Mail\customerEmailVerification;
use App\Mail\driverEmailVerification;
use App\Mail\customerSignedupMail;
use App\Mail\driverSignedupMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show the customer signup page.
     */
    public function customerSignup()
    {
        return view('auth.customerSignup');
    }

    /**
     * Show the customer login page.
     */
    public function customerLogin()
    {
        return view('auth.customerLogin');
    }

    /**
     * Show the driver signup page.
     */
    public function driverSignup()
    {
        return view('auth.driverSignup');
    }

    /**
     * Show the driver login page.
     */
    public function driverLogin()
    {
        return view('auth.driverLogin');
    }

    /**
     * Store customer information and register them.
     */
    public function customerStore(Request $request)
    {
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|unique:customers,email',
            'contact' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ], [
            'username.regex' => 'Username must contain only numbers and alphabets.',
            'email.email' => 'Email must be a valid email address.',
            'contact.numeric' => 'Contact must contain only numbers.',
        ]);

        $customer = new Customer();
        $customer->name = $request->username;
        $customer->email = $request->email;
        $customer->phone = $request->contact;
        $customer->password = Hash::make($request->password);

        $customer->email_verification_token = Str::random(64);

        $customer->save();

        Mail::to($customer->email)->send(new CustomerEmailVerification($customer));

        return redirect()->route('customer.login')->with('success', 'customer registered successfully. Please log in');
    }

    public function checkcustomerEmail(Request $request)
    {
        $exists = Customer::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }

public function customerAuthenticate(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // if (auth('driver')->check()) {
    //     auth('driver')->logout();
    // }

    $customer = Customer::where('email', $request->email)->first();

    if ($customer && Hash::check($request->password, $customer->password)) {
        // Log the user in with the 'customer' guard
        // Temporarily disable email verification for testing
        // if (!$customer->email_verified_at) {
        //     return redirect()->route('customer.login')->with('error', 'Your email is not verified. Please check your email');
        // }

        Auth::guard('customer')->login($customer);

        Mail::to($customer->email)->send(new CustomerLoggedInMail($customer));

        // Debugging logs to confirm
        Log::info('User Logged In: '   . $customer->email);

        // Redirect to the customer panel
        return redirect()->route('customer.panel');
    }

    // If authentication fails, redirect back with an error
    Log::info('Authentication Failed for: ' . $request->email);
    return redirect()->route('customer.login')->with('error', 'Invalid credentials');
}
    /**
     * Store driver information and register them.
     */
    public function customerLogout(Request $request)
    {

        Auth::guard('customer')->logout(); 
    
        // Invalidate the session (for security reasons)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirect to the login page or homepage
        return redirect()->route('customer.login')->with('success', 'You have successfully logged out');
    }



    public function driverStore(Request $request)
    {
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|unique:drivers,email',
            'contact' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ], [
            'username.regex' => 'Username must contain only numbers and alphabets.',
            'email.email' => 'Email must be a valid email address.',
            'contact.numeric' => 'Contact must contain only numbers.',
        ]);

        $driver = new Driver();
        $driver->name = $request->username;
        $driver->email = $request->email;
        $driver->phone = $request->contact;
        $driver->password = Hash::make($request->password);

        $driver->email_verification_token = Str::random(64);
        $driver->save();

        Mail::to($driver->email)->send(new DriverEmailVerification($driver));

        return redirect()->route('driver.login')->with('success', 'driver registered successfully. Please log in');
    }
    public function checkdriverEmail(Request $request)
{
    $exists = Driver::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
}

    /**
     * Authenticate the driver and log them in.
     */
    public function driverAuthenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // if (auth('customer')->check()) {
        //     auth('customer')->logout();
        // }

        $driver = Driver::where('email', $request->email)->first();

        if ($driver && Hash::check($request->password, $driver->password)) {

            // Temporarily disable email verification for testing
            // if (!$driver->email_verified_at) {
            //     return redirect()->route('driver.login')->with('error', 'Your email is not verified. Please check your email');
            // }
            
            Auth::guard('driver')->login($driver);

            Mail::to($driver->email)->send(new DriverLoggedInMail($driver));

            Log::info('User Logged In: ' . $driver->email);

        // Redirect to the customer panel
              return redirect()->route('driver.panel');
        }

        return redirect()->route('driver.login')->with('error', 'Invalid credentials');
    }

    public function driverLogout(Request $request)
    {
        // Manually log out the customer
        Auth::guard('driver')->logout(); // Log out using the 'customer' guard
    
        // Invalidate the session (for security reasons)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('driver.login')->with('success', 'You have successfully logged out');
    }

    public function Profile() {
        if (auth('customer')->check()) {
            $user = auth('customer')->user();
            $userType = 'customer';
        } 
        
        else {
            $user = auth('driver')->user();
            $userType = 'driver';
        }
    
        return view('Auth.profile', compact('user', 'userType'));
    }
    
    public function updateProfile(Request $request) {

        if (auth('customer')->check()) {
            $user = auth('customer')->user();
        } 
        else {
            $user = auth('driver')->user();
        }
    
        $request->validate([
            'contact' => 'numeric',
            'username' => 'required|regex:/^[a-zA-z0-9]+$/',
            'email' => 'email',
        ],[
            'username.regex' => 'Username must contain only numbers and alphabets.',
            'email.email' => 'Email must be a valid email address.',
            'contact.numeric' => 'Contact must contain only numbers.',
        ]);
    
        $user->username = $request->username;
        $user->email = $request->email;
        $user->contact = $request->contact;
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully');;
    }
    
    public function passwordChange() {
        if (auth('customer')->check()) {
            $user = auth('customer')->user();
            $userType = 'customer';
        } 
        
        else {
            $user = auth('driver')->user();
            $userType = 'driver';
        }
    
        return view('Auth.passwordchange', compact('user', 'userType'));
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'newPassword' => 'required|min:8|confirmed',
        ]);
    
        if (auth('customer')->check()) {
            $user = auth('customer')->user();
            $redirectRoute = 'customer.profile';
        } 
        else {
            $user = auth('driver')->user();
            $redirectRoute = 'driver.profile';
        }

        $user->password = bcrypt($request->newPassword);
        $user->save();
    
        return redirect()->route($redirectRoute)->with('success', 'Password updated successfully');
    }
    public function adminLogin()
{
    return view('Admin.admin-login');
}


public function adminAuthenticate(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required',
    ]);

    $admin = Admin::where('username', $request->username)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard')->with('success', 'Welcome to the admin panel');
    }

    return redirect()->route('admin.login')->with('error', 'Invalid credentials');
}

public function adminLogout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login')->with('success', 'You have successfully logged out');
}

}
