<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountAndRoleController extends Controller
{
    public function index()
    {
        $accounts = User::all();
        return view('management.account_and_role', compact('accounts'));
    }

    public function create()
    {
        return view('management.create_account');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('account_and_role.index')->with('success', 'Account created successfully.');
    }

    public function edit(User $user)
    {
        return view('management.edit_account', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('account_and_role.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('account_and_role.index')->with('success', 'Account deleted successfully.');
    }
}
