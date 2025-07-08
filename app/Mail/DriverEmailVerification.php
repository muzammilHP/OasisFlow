<?php

namespace App\Mail;

use App\Models\Driver;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DriverEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $driver;
    public $verificationUrl;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
        // Generate the verification URL with the email verification token
        $this->verificationUrl = route('verify.driverEmail', ['token' => $driver->email_verification_token]);
    }

    public function build()
    {
        return $this->view('Email.verifydriver')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                        'driverName' => $this->driver->username,
                    ]);
    }
}