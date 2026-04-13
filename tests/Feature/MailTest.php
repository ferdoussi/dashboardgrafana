<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_mail_is_sent_without_mailtrap()
    {
        // 1️⃣ Fake Mail
        Mail::fake();

        // 2️⃣ Create a dummy employee
        $employee = Employee::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@fortress360.io',
            'role' => 'user',
            'company' => 'TestCompany',
            'client_id' => 1,
            'password' => bcrypt('Password1@'),
        ]);

        // 3️⃣ Trigger the Mail manually (simulate Event)
        Mail::to('superadmin@fortress360.io')->send(new NewUserAlert($employee));

        // 4️⃣ Assert that Mail was "sent"
        Mail::assertSent(NewUserAlert::class, function ($mail) use ($employee) {
            return $mail->employee->id === $employee->id;
        });
    }
}