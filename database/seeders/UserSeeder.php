<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuario Admin
        User::create([
            'name' => 'Roberto Admin',
            'email' => 'admin@kopion.com',
            'password' => Hash::make('password123'),
            'role_id' => 1, // Admin
            'branch_id' => 1,
            'school_id' => null,
            'customer_type' => null,
        ]);

        // 2. Usuario Empleado
        User::create([
            'name' => 'Empleado Juan',
            'email' => 'juan@kopion.com',
            'password' => Hash::make('password123'),
            'role_id' => 3, // Employee
            'branch_id' => 2,
            'school_id' => null,
            'customer_type' => null,
        ]);

        // 3. Usuario Cliente (Alumno)
        User::create([
            'name' => 'Alumno Pedro',
            'email' => 'pedro@alumno.com',
            'password' => Hash::make('password123'),
            'role_id' => 4, // Customer
            'branch_id' => null,
            'school_id' => 1,
            'customer_type' => 'Student',
        ]);
    }
}