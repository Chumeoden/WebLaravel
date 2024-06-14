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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);
    
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
    
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }
    
        $user->save();
    
        return redirect()->route('account_and_role.index')->with('success', 'Account updated successfully.');
    }
    
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('account_and_role.index')->with('success', 'Account deleted successfully.');
    }
}
