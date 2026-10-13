<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Branch;
use App\Models\School;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Llenar catálogos dependientes
        Role::insert([
            ['name' => 'Admin'], 
            ['name' => 'Editor'], 
            ['name' => 'Employee'], 
            ['name' => 'Customer']
        ]);

        Branch::insert([
            ['name' => 'Kopion CECyT', 'branch_type' => 'Stationery'],
            ['name' => 'Kopion ESCA', 'branch_type' => 'Stationery'],
            ['name' => 'La Capital del Cafe', 'branch_type' => 'Cafeteria']
        ]);

        School::insert([
            ['name' => 'CECyT 1'], 
            ['name' => 'ESCA Santo Tomas']
        ]);

        // 2. Ejecutar el seeder de tus 3 usuarios
        $this->call(UserSeeder::class);

        // 3. Crear 50 órdenes falsas con el Factory
        Order::factory(50)->create();
    }
}