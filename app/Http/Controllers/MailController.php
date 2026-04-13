<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserAlert;

class MailController extends Controller
{
    public function sendNewUserAlert($id)
    {
        $employee = Employee::findOrFail($id);

        // email dyal super admin
        $superAdminEmail = 'anas.ferdoussi@qokpit3d.io';

        Mail::to($superAdminEmail)->send(new NewUserAlert($employee));

        return "Email envoyé au Super Admin";
    }
}