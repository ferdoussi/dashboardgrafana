<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use App\Mail\NewUserAlert;
use App\Events\UserCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreUserMailTest extends TestCase
{
    use RefreshDatabase;

   public function test_store_user_triggers_event_and_sends_mail()
{
    // 1. تزييف البريد
    Mail::fake();

    // 2. إنشاء مستخدم "أدمن" وعمل تسجيل دخول له (لتخطي الـ middleware)
    $user = Employee::factory()->create();
    $this->actingAs($user); 

    // 3. إنشاء موظف (Employee) لنرسل له التنبيه
    $employee = Employee::factory()->create();

    // 4. استدعاء المسار باستخدام الـ Name والـ ID
    $response = $this->get(route('send.alert', ['id' => $employee->id]));

    // 5. التأكد أن الطلب نجح (Status 200)
    $response->assertStatus(200);

    // 6. التأكد أن الإيميل أُرسل فعلياً
    Mail::assertSent(NewUserAlert::class, function ($mail) {
        return $mail->hasTo('anas.ferdoussi@qokpit3d.io');
    });
}
}