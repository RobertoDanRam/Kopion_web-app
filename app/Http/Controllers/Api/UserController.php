<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar usuarios (GET)
    public function index()
    {
        // Se incluyen los campos branch_id, school_id y customer_type para visualizar la información completa en Postman
        return User::select('id', 'name', 'email', 'role_id', 'branch_id', 'school_id', 'customer_type', 'is_active', 'created_at')
            ->orderBy('id', 'desc')
            ->paginate(15);
    }

    // Crear un nuevo usuario (POST)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'school_id' => 'nullable|integer|exists:schools,id',
            'customer_type' => 'nullable|in:Student,Professor,Other',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Obtener un usuario específico (GET)
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        return response()->json($user, 200);
    }

    // Actualizar información básica del usuario (PUT/PATCH)
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'sometimes|required|integer|exists:roles,id',
            'branch_id' => 'sometimes|nullable|integer|exists:branches,id',
            'school_id' => 'sometimes|nullable|integer|exists:schools,id',
            'customer_type' => 'sometimes|nullable|in:Student,Professor,Other',
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

    // Cambiar el estado del usuario a inactivo (DELETE)
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Cambiamos el estado a inactivo en lugar de borrarlo físicamente
        $user->update(['is_active' => false]); 

        return response()->json([
            'message' => 'User status successfully changed to inactive.',
            'user' => $user
        ], 200);
    }
}