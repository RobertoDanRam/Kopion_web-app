<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //   listar usuarios (GET)
    public function index()
    {
        return User::select('id', 'name', 'email', 'role_id', 'created_at')
            ->orderBy('id', 'desc')
            ->paginate(15);
    }

    //  crear un nuevo usuario (POST)
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|integer|exists:roles,id',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['customer_type'] = 'Other'; // Valor por defecto para la estructura de Kopion

    $user = User::create($validated);

    return response()->json($user, 201);
}

    public function show(string $id) { /* ... */ }
    public function update(Request $request, string $id) { /* ... */ }
    public function destroy(string $id) { /* ... */ }
}