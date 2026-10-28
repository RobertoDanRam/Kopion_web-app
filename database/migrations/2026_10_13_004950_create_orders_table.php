<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->nullable(); // Agregado para Evidencia 2
            $table->foreignId('user_id')->constrained('users'); // Cliente
            $table->foreignId('employee_id')->nullable()->constrained('users'); // Empleado que atendio
            $table->foreignId('branch_id')->constrained('branches');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
            $table->softDeletes(); // Agregado para el borrado lógico (Archive) de la Evidencia 2
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};