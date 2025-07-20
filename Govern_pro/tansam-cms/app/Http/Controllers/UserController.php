<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' =>  'required|string'
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.show')->with('success','Created Successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'nullable|email',
            'password' => 'nullable|string'
        ]);

        $user = User::findOrFail($id);

        $data=[];
        $data["email"]=$request->email;
        if($request->filled('password')) {
            $data["password"] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.show')->with('success', 'Updated Successfully!');
    }
}
