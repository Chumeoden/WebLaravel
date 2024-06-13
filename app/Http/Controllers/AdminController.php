<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }

    public function makeAdmin($id)
{
    $user = User::find($id);
    if ($user) {
        $user->is_admin = true;
        $user->save();
    }
    return redirect()->route('admin.dashboard')->with('success', 'User is now an admin');
}

public function updateRole(Request $request, $id)
{
    $user = User::find($id);
    if ($user) {
        $user->role = $request->role;
        $user->save();
    }
    return redirect()->route('admin.dashboard')->with('success', 'User role updated successfully');
}


}
