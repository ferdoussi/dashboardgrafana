<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('company', 'like', "%{$request->search}%");
        }

        // Filter by role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        $employees = $query->latest()->paginate(8);
        
        
        $clients = Client::all(); 

        
        return view('superAdmin.superAdmin', compact('employees', 'clients'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'company' => 'nullable|string|max:255',
            'role' => 'required|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);

        $employee->update($request->only('name', 'email', 'company', 'role') + [
            'password' => bcrypt($request->password)
        ]);
        $admins = Employee::where('client_id', $employee->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

$currentUser = Auth::user(); 
$currentUserRole = $currentUser->role;

$message = "Employee {$employee->name} has been updated in company {$employee->company} by {$currentUser->name} ({$currentUserRole})";
$icon = "bx-edit";

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}


        return redirect()->route('superAdmin.superAdmin')->with('success', translate('Employee updated successfully'));
    }   

    public function destroy(Employee $employee)
    {
        $employee->delete();
        $admins = Employee::where('client_id', $employee->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

$message = "Employee {$employee->name} has been deleted";
$icon = "bx-trash";

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}

$employee->delete();

        return redirect()->route('superAdmin.superAdmin')->with('success', translate('Employee deleted successfully'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:employees,email',
                'regex:/^.+@(fortress360|qokpit3d\.io)$/i'
            ],
            'company_id' => 'required_if:company_id,!=,new',
            'new_company' => 'required_if:company_id,==,new',
            'role' => 'required',
            'password' => 'required|min:6',
        ], [
            'email.regex' => 'The email must belong to fortress360 or qokpit3d.io domain.',
        ]);

        
        if ($request->filled('company_id') && $request->company_id !== 'new') {
            
            $clientId = $request->company_id;
            $client = Client::find($clientId);
            $companyName = $client->name;
        } else {
           
            $newClient = Client::firstOrCreate(
                ['name' => trim($request->new_company)]
            );
            $clientId = $newClient->id;
            $companyName = $newClient->name;
        }

        
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->company = $companyName;
        $employee->role = $request->role;
        $employee->password = bcrypt($request->password);
        $employee->client_id = $clientId; 
        
        $employee->save();
      
$admins = Employee::where('client_id', $employee->client_id)
                  ->whereIn('role', ['superadmin'])
                  ->get();

$currentUser = Auth::user();
$currentUserRole = $currentUser->role;

$message = "Employee {$employee->name} has been created in company {$employee->company} by {$currentUser->name} ({$currentUserRole})";
$icon = "bx-user-plus";

foreach($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}


        return redirect()->back()->with('success', "User Created and Linked to Client ID: $clientId");
    }
}