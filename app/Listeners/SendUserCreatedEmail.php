<?php

namespace App\Listeners;

use App\Events\UserCreated; 
use App\Mail\NewUserAlert;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;

class SendNewUserMail
{
    public function handle(UserCreated $event)
    {
        $superadmins = Employee::where('role', 'superadmin')->get();

        foreach ($superadmins as $admin) {
            Mail::to($admin->email)->send(new NewUserAlert($event->employee));
        }
    }
}