<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create($request->all());

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $adminUser = auth()->user();

        // if ($user->id !== $adminUser->id) {
        //     if ($user->role_id == 1) {
        //         $user->update(['status' => 'deactivate']);
        //     } else {
        //         $user->delete();
        //     }
        //     return redirect()->back()->with('success', 'User berhasil dihapus');
        // } else {
        //     return redirect()->back()->with('error', 'Anda tidak dapat menghapus diri sendiri');
        // }
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }
}
