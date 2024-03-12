<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create(){
        return Inertia::render('Admin/User/Create');
    }

    public function store(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success','User created.');
    }

    public function edit(User $user){
        return Inertia::render('Admin/User/Edit',['user'=>$user]);
    }


    public function update(Request $request, User $user){

        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'user updated successfully.');

    }

    public function destroy(User $user){

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'user deleted successfully.');

    }
}
