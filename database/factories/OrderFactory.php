<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Branch;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Asigna a un cliente aleatorio 
            'user_id' => User::where('role_id', 4)->inRandomOrder()->first()->id ?? 3,

            // Asigna a un empleado/admin aleatorio (Roles 1, 2, 3)
            'employee_id' => User::whereIn('role_id', [1, 2, 3])->inRandomOrder()->first()->id ?? 1,

            // Asigna una sucursal 
            'branch_id' => Branch::inRandomOrder()->first()->id ?? 1,

            // Faker genera un monto total entre $10 y $1000 con 2 decimales
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),

            // Faker elige un estado aleatorio de la lista
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']),
        ];
    }
}