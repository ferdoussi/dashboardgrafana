<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\Client;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        // إنشاء Client dummy عبر Factory
        $client = Client::factory()->create();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'user',
            'company' => 'TestCompany',
            'client_id' => $client->id,
            'password' => bcrypt('Password1@'),
        ];
    }
}