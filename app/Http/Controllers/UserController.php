<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    //funcion para mostrar un solo usuario
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Asignar rol por defecto 'client'
        $defaultRole = Role::where('name', 'client')->first();
        $user->roles()->attach($defaultRole);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    //asignar rol a un usuario especifico sirve para admin
    public function assignRole(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
    
        $user->roles()->attach($validatedData['role_id']);
        return response()->json(['message' => 'Role assigned successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Verificar si el usuario autenticado es el mismo que intenta actualizar
        if (Auth::id() !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
        ]);
    
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
    
        $user->update($validatedData);
        return response()->json(['user' => $user], 200);
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['massage' => 'User deleted successfully'], 200);
    }
}
