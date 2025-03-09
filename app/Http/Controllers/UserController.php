<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        session()->flash('success', 'Role added successfully.');

        return to_route('user.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'email',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // return redirect()->route('user.index');
        // return redirect('user');
        return to_route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'email',
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return to_route('user.index');
    }

    public function destroy($id)
    {

        // $user = User::find($id);
        // $user->delete();

        User::destroy($id);

        return to_route('user.index');
    }
}
