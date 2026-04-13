<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserAlert extends Mailable
{
     use Queueable, SerializesModels;

    public $employee; // لازم يكون public باش PHPUnit يقدر يشوفه

    public function __construct(Employee $employee)
    {
        $this->employee = $employee; // assign
    }

    public function build()
{
    return $this->subject('🔔 New User Alert - Yokamos')
                ->view('emails.new_user_alert')
                ->with([
                    'newEmployee' => $this->employee, // hadi ghadi tkhlli Blade y9ra $newEmployee
                ]);
}
}