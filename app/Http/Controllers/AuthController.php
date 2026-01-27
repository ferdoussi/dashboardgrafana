<?php

namespace App\Http\Controllers;

use App\Models\Employee; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('app.home');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            
        ]);

        $employee = Employee::where('email', $credentials['email'])

            ->first();

        if (!$employee || !Hash::check($credentials['password'], $employee->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis ne correspondent pas à nos enregistrements.'],
            ]);
        }

        // 🔐 تخزين المعرف مؤقتاً في السيسيون
        session(['2fa:user:id' => $employee->id]);

        // 🚩 التحقق من حالة google2fa_enabled في قاعدة البيانات
        if ($employee->google2fa_enabled) {
            // حالة أنس (True): يمشي يكتب الكود فقط
            return redirect()->route('2fa.verify');
        }

        // حالة نزار ويوسف (False): يمشي يسكاني QR لأول مرة
        return redirect()->route('2fa.setup');
    }

    // --- أول مرة: إعداد 2FA ---
public function show2faSetup()
{
    $employeeId = session('2fa:user:id');
    if (!$employeeId) return redirect()->route('login');

    $employee = Employee::find($employeeId);
    $google2fa = new Google2FA();

    // 1. توليد السكرت
    $secret = $google2fa->generateSecretKey();
    session(['2fa_secret' => $secret]);

    // 2. هاد السطر كيعطيك النص (otpauth://...) هادا مكيخدمش فـ <img> نيشان
    $otpAuthUrl = $google2fa->getQRCodeUrl(
        'Yokamos App', 
        $employee->email, 
        $secret
    );

    // 3. ✅ هادا هو الحل: كنحولوا هاداك النص لرابط صورة حقيقية
   $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($otpAuthUrl);

    // 4. دابا صيفط المتغير للـ Blade
    return view('2fa-setup', compact('qrCodeUrl', 'secret'));
}
    public function enable2fa(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $employeeId = session('2fa:user:id');
        $secret = session('2fa_secret');
        $employee = Employee::find($employeeId);

        if (!$employee || !$secret) return redirect()->route('login');

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            // حفظ المفتاح وتفعيل الخاصية في الداتابيز
            $employee->google2fa_enabled = true;
            $employee->google2fa_secret = $secret;
            $employee->save();

            return $this->completeLogin($employee);
        }

        return back()->withErrors(['code' => 'Code OTP incorrect ❌']);
    }

    // --- المرات الجاية: التحقق من 2FA ---
    public function show2faForm()
    {
        if (!session('2fa:user:id')) return redirect()->route('login');
        return view('2fa-verify');
    }

    public function check2fa(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $employeeId = session('2fa:user:id');
        $employee = Employee::find($employeeId);

        if (!$employee) return redirect()->route('login');

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($employee->google2fa_secret, $request->code);

        if ($valid) {
            return $this->completeLogin($employee);
        }

        return back()->withErrors(['code' => 'Code incorrect ❌']);
    }

    // دالة لإنهاء تسجيل الدخول وضبط الـ Client Session
    private function completeLogin($employee)
    {
        Auth::login($employee);

        $email = $employee->email;
        $client = 'default';
        if (str_ends_with($email, '@fortress360')) $client = 'fortress';
        elseif (str_ends_with($email, '@qokpit3d.io')) $client = 'qokpit3d';

        session(['client' => $client]);
        session()->forget(['2fa:user:id', '2fa_secret']);

        return redirect()->route('app.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}