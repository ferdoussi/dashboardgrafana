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
        // 👑 Admin
        Employee::create([
            'name'        => 'Nizar',
            'email'       => 'nizar@fortress360',
            'password'    => Hash::make('secret'), 
            'departement' => 'Informatique',
            'role'        => 'admin',
            'company' => 'Fortress 360', // <--- زيد هاد السطر هنا
        ]);
        
        // 👤 User - Sécurité
        Employee::create([
            'name'        => 'Anass',
            'email'       => 'anas.ferdoussi@qokpit3d.io',
            'password'    => Hash::make('secret'),
            'departement' => 'Sécurité',
            'role'        => 'user',
            'company' => 'Fortress 360', // <--- زيد هاد السطر هنا
        ]);

        // 👤 User - Informatique (الجديد)
        Employee::create([
            'name'        => 'Youssef',
            'email'       => 'youssef@fortress360',
            'password'    => Hash::make('secret'),
            'departement' => 'Informatique',
            'role'        => 'user',
            'company' => 'Fortress 360', // <--- زيد هاد السطر هنا
        ]);
    }
}
