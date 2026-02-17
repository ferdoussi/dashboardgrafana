<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Exécute le remplissage de la base de données.
     */
    public function run(): void
    {
        $employees = [
            [
                'name'     => 'Nizar',
                'email'    => 'nizar@fortress360',
                'password' => Hash::make('secret'), 
                'role'     => 'admin',
                'company'  => 'Fortress 360',
            ],
            [
                'name'     => 'Anass',
                'email'    => 'anas.ferdoussi@qokpit3d.io',
                'password' => Hash::make('secret'),
                'role'     => 'user',
                'company'  => 'Fortress 360',
            ],
            [
                'name'     => 'Youssef',
                'email'    => 'youssef@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'user',
                'company'  => 'Fortress 360',
            ],
            [
                'name'     => 'Sara',
                'email'    => 'sara@fortress360',
                'password' => Hash::make('secret'),
                'role'     => 'user',
                'company'  => 'Fortress 360',
            ],
        ];

        foreach ($employees as $employeeData) {
            // نستخدم الإيميل كمعيار للبحث، إذا وجده يُحدث الباقي، وإذا لم يجده يُنشئ سجل جديد
            Employee::updateOrCreate(
                ['email' => $employeeData['email']], 
                $employeeData
            );
        }
    }
}