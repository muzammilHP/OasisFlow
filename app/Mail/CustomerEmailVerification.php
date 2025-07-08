<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $verificationUrl;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        // Generate the verification URL with the email verification token
        $this->verificationUrl = route('verify.customerEmail', ['token' => $customer->email_verification_token]);
    }

    public function build()
    {
        return $this->view('Email.verifycustomer')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                        'customerName' => $this->customer->username,
                    ]);
    }
}