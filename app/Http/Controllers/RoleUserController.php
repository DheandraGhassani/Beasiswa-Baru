<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUsers = RoleUser::all();
        return response()->json($roleUsers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $roleUser = RoleUser::create($validatedData);

        return response()->json($roleUser, 201);
    }

    public function show(RoleUser $roleUser)
    {
        return response()->json($roleUser);
    }

    public function update(Request $request, RoleUser $roleUser)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $roleUser->update($validatedData);

        return response()->json($roleUser);
    }

    public function destroy(RoleUser $roleUser)
    {
        $roleUser->delete();
        return response()->json(null, 204);
    }
}
