<?php
use App\Services\{QradarService, QradarNormalizer, MitreMatrixBuilder,MitreMapper};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrafanaProxyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PanelController;






// DashboardController referenced by string in routes to avoid missing-type static error.
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// مسارات 2FA (خارج middleware auth لأن المستخدم لم يسجل دخوله كاملاً بعد)
Route::get('/2fa-setup', [AuthController::class, 'show2faSetup'])->name('2fa.setup');
Route::post('/2fa-enable', [AuthController::class, 'enable2fa'])->name('2fa.enable');
Route::get('/2fa-verify', [AuthController::class, 'show2faForm'])->name('2fa.verify');
Route::post('/2fa-check', [AuthController::class, 'check2fa'])->name('2fa.check'); 

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
}); 


// Route::get('/grafana', function () {
//     return view('grafana');
// })->middleware('auth')->name('grafana');;

// route for home page after login
Route::get('/app', function () {
    return view('app.home');
})->middleware('auth')->name('app.home');
// route for create dashboard page
Route::middleware('auth')->group(function () {

    Route::get('/dashboard/create', 'App\Http\Controllers\DashboardController@create')
        ->name('dashboard.create');

    Route::get('/dashboard/{type}', 'App\Http\Controllers\DashboardController@show')
        ->name('dashboard.show');

    Route::post('/dashboard/save-custom', 'App\Http\Controllers\DashboardController@saveCustomLayout')
        ->name('dashboard.saveCustom');

    Route::get('/my-dashboard', 'App\Http\Controllers\DashboardController@myDashboard')
        ->name('dashboard.myDashboard');
       
    Route::get('/dashboard/view-custom/{id}', 'App\Http\Controllers\DashboardController@viewCustom')
        ->name('dashboard.viewCustom');
    Route::delete('/dashboard/delete/{id}', 'App\Http\Controllers\DashboardController@deleteDashboard')
        ->name('dashboard.delete');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support.support'); 
    // routes/web.php

    Route::get('/super-admin', [EmployeeController::class, 'index'])->name('superAdmin.superAdmin');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
    ->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
    ->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
    ->name('employees.destroy');
    Route::post('/employees', [EmployeeController::class, 'store'])
    ->name('employees.store');
  Route::post('/employees/{employee}/toggle-status', [EmployeeController::class, 'toggleStatus'])
    ->name('employees.toggleStatus');


});
Route::middleware(['auth'])->group(function () {
    Route::get('/all-users', [App\Http\Controllers\EmployeeManagementController::class, 'allUser'])->name('clientFile.allUser');
    Route::get('/employee/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'showClient'])->name('clientFile.employeeDetails');
    Route::get('/employee/{employee}/edit', [App\Http\Controllers\EmployeeManagementController::class, 'editClient'])->name('clientFile.editEmployee');
    Route::put('/employee/{employee}', [App\Http\Controllers\EmployeeManagementController::class, 'updateClient'])->name('clientFile.updateEmployee');
   Route::delete('/employee/{employee}', [App\Http\Controllers\EmployeeManagementController::class, 'destroyClient'])->name('clientFile.deleteEmployee');
   Route::post('/employee', [App\Http\Controllers\EmployeeManagementController::class, 'storeUser'])->name('clientFile.storeUser');
});
// routes/web.php

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::delete('/settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.delete');
});


Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->middleware('auth')
    ->name('notifications.read');
Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification'])
    ->middleware('auth')
    ->name('notifications.delete');



Route::get('/test-mitre', function () {
    $raw = App\Services\QradarService::getOffenses();
    $offenses = App\Services\QradarNormalizer::normalize($raw);
    
    
    $matrix = App\Services\MitreMatrixBuilder::build($offenses);

    
    $tacticsOrder = [
        'Reconnaissance', 'Resource Development', 'Initial Access', 
        'Execution', 'Persistence', 'Privilege Escalation', 
        'Defense Evasion', 'Credential Access', 'Discovery', 
        'Lateral Movement', 'Collection', 'Command and Control', 
        'Exfiltration', 'Impact'
    ];

    return view('mitre.matrix', compact('matrix', 'tacticsOrder'));
})->name('mitre.matrix')->middleware('auth');


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        Session::put('locale', $locale);
        Session::save(); 
    }
    return redirect()->back();
})->name('lang.switch')->middleware('auth');

Route::get('/keep-session', function () {
    session()->put('keep_alive', true);
    return response()->json(['status' => 'ok']);
})->middleware('auth');


Route::get('/send-alert/{id}', [MailController::class, 'sendNewUserAlert'])
    ->name('send.alert')
    ;

Route::get('/add-panel', [PanelController::class, 'viewCreateForm'])->name('panels.viewCreateForm');
Route::post('/add-panel', [PanelController::class, 'createPanel'])->name('panels.createPanel');