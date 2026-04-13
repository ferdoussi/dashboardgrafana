<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}