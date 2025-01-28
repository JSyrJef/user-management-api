<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::create($validatedData);
        return response()->json(['role' => $role], 201);
    }

    public function show(Role $role)
    {
        return response()->json(['role' => $role], 200);
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($validatedData);
        return response()->json(['role' => $role], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
