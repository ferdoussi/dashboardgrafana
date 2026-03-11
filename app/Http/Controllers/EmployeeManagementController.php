<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeManagementController extends Controller
{
    public function allUser(Request $request)
    {
        $auth = Auth::user();

        $query = Employee::query();

        if ($auth->role !== 'superadmin') {
            $query->where('company', $auth->company)
                  ->where('client_id', $auth->client_id);
        }

        // 🔍 Search (name email)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // 🎭 Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 📄 Pagination ( dashboard)
        $employees = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('clientFile.allUser', compact('employees'));
    }

    public function showClient($id)
    {
        $employee = Employee::findOrFail($id);
        return view('clientFile.employeeDetails', compact('employee'));
    }
    public function editClient(Employee $employee)
    {
        return view('clientFile.editEmployee', compact('employee'));
    }
  public function updateClient(Request $request, Employee $employee)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $employee->id,
        'role' => 'required|string',
        'company' => 'nullable|string', 
        'password' => 'nullable|string|min:8', 
    ]);

    
    $data = $request->only('name', 'email', 'role', 'company');

    
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }
    $currentUser = Auth::user(); 
$currentUserRole = $currentUser->role;

$message = "Employee {$employee->name} has been updated in company {$employee->company} by {$currentUser->name} ({$currentUserRole})";
$icon = "bx-user-plus";

$admins = Employee::where('role', 'admin')->where('company', $employee->company)->get();

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}

    $employee->update($data);
     
$admins = Employee::where('client_id', $employee->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

$currentUser = Auth::user();
$currentUserRole = $currentUser->role;

$message = "Employee {$employee->name} has been updated in company {$employee->company} by {$currentUser->name} ({$currentUserRole})";
$icon = "bx-user-plus";

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}
    return redirect()->route('clientFile.allUser')
                     ->with('success', 'Employee updated successfully.');
}
    public function destroyClient(Employee $employee)
    {
        
        $employee->delete();
                
$admins = Employee::where('client_id', $employee->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

$currentUser = Auth::user(); 
$currentUserRole = $currentUser->role;

$message = "Employee {$employee->name} has been deleted from company {$employee->company} by {$currentUser->name} ({$currentUserRole})";
$icon = "bx-user-minus";

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}
        return redirect()->route('clientFile.allUser')->with('success', 'Employee deleted successfully.');
    }


   public function storeUser(Request $request)
{
    // Check limit dyal 10 users (Beddel had 2 b 10)
    $userCount = Employee::count(); 
    
    if ($userCount >= 10) {
        return redirect()->back()->withErrors(['limit' => 'Limit reached: You cannot add more than 10 users.']);
    }
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'regex:/^.+@(fortress360|qokpit3d\.io)$/i',
            // Custom check bach n-choufo ghir l-prefix dial l-email
            function ($attribute, $value, $fail) {
                $username = explode('@', $value)[0]; // Kan-akhdo ghir dakchi li 9bel @
                
                $exists = \App\Models\Employee::where('email', 'LIKE', $username . '@%')->exists();
                
                if ($exists) {
                    $fail('The username "' . $username . '" is already taken with another domain.');
                }
            },
        ],
        'role' => 'required|string',
                'password' => [
                'required',
                'string',
                'min:8',             // Labodda men 8 dyal l-caractères
                'regex:/[a-z]/',      // Khass darori 7arf sghir
                'regex:/[A-Z]/',      // Khass darori 7arf kbir
                'regex:/[0-8]/',      // Khass darori ra9m
                'regex:/[@$!%*#?&]/', // Khass darori symbol (special character)
            ],
            
            [
            'email.regex' => 'Please use @fortress360 or @qokpit3d.io only.',
            // 'password'   => translate('Password must be at least 8 characters.'),
            'password' => translate('Password must include uppercase, lowercase, numbers, and special characters (@$!%*#?&).')
        ]
    ]);

    $auth = Auth::user();

    
    $employee = Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'company' => $auth->company, 
        'client_id' => $auth->client_id, 
        'password' => bcrypt($request->password),
    ]);

    
    $admins = Employee::where('role', 'superadmin')->get();
    
    $message = "Employee {$employee->name} created in {$employee->company} by {$auth->name} ({$auth->role})";
    $icon = "bx-user-plus";

    foreach($admins as $admin) {
        $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
    }

    return redirect()->route('clientFile.allUser')->with('success', 'Employee created successfully.');
}
}
