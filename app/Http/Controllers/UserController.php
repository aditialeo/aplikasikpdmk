<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return view('user.index',compact('user'));
    }

    public function create()
    {
        return view('user.create');
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

        return view('user.edit',compact('user'));
    }

    public function update($id,Request $request){

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

    public function destroy($id){

        // $user = User::find($id);
        // $user->delete();

        User::destroy($id);

        return to_route('user.index');
    }
}
