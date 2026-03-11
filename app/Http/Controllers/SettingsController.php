<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Notifications\SystemNotification;


class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

public function updateProfile(Request $request)
{
    /** @var Employee $user */
    $user = Auth::user();
 
    $rules = [
        'name' => 'required|string|max:255',
       
        'current_password' => 'required', 
    ];

    if ($request->filled('password')) {
        $rules['password'] = 'required|min:8'; 
    }

    $request->validate($rules);

  
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'The current password is incorrect.'
        ])->withInput(); 
    }

   
    $user->name = $request->name;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

$user->save();
$user->notify(
    new SystemNotification(
        'Profile updated successfully!',
        'bx-user',
        $user->client_id
    )
);

$admins = Employee::where('client_id', $user->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

foreach($admins as $admin) {
    $admin->notify(
        new SystemNotification(
            "{$user->name} updated his profile from {$user->company} account",
            'bx-edit',
            $admin->client_id
        )
    );
}

    return redirect()->back()->with('success', 'Account updated successfully!');
}
   
// public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     if (!Hash::check($request->current_password, Auth::user()->password)) {
    //         return back()->withErrors(['current_password' => 'Wrong password']);
    //     }
    //     /** @var Employee $user */
    //     $user = Auth::user();
    //     $user->update([
    //         'password' => Hash::make($request->password)
    //     ]);

    //     return back()->with('success','Password updated');
// }

    public function deleteAccount()
    {
        /** @var Employee $user */
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/');
    }
}