<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ صايب clients
        $companies = [
            'Fortress 360',
        ];

        foreach($companies as $company){
            Client::updateOrCreate(['name' => $company]);
        }

        $fortressClient = Client::where('name', 'Fortress 360')->first();

        // 2️⃣ صايب employees مع كل role
        $employees = [
            [
                'name'     => 'Super Admin',
                'email'    => 'superadmin@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'superadmin',
                'company'  => 'Yokamos',
                'client_id'=> $fortressClient->id,
            ],
            [
                'name'     => 'Admin',
                'email'    => 'nizar@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'admin',
                'company'  => 'Yokamos',
                'client_id'=> $fortressClient->id,
            ],
            [
                'name'     => 'Client Admin',
                'email'    => 'clientadmin@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'admin_client',
                'company'  => 'Fortress 360',
                'client_id'=> $fortressClient->id,
            ],
            [
                'name'     => 'Anass',
                'email'    => 'anas.ferdoussi@qokpit3d.io',
                'password' => Hash::make('secret'),
                'role'     => 'user',
                'company'  => 'Fortress 360',
                'client_id'=> $fortressClient->id,
            ],
            [
                'name'     => 'Youssef',
                'email'    => 'youssef@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'user',
                'company'  => 'Fortress 360',
                'client_id'=> $fortressClient->id,
            ],
        ];

        foreach ($employees as $employeeData) {
            Employee::updateOrCreate(
                ['email' => $employeeData['email']],
                $employeeData
            );
        }
    }
}
