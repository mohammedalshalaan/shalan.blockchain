<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        return view('users.index',['users'=>$users]);
    }
    public function create()
    {
        return view('users.create');
    }

    public function show(user $user)
    {
        return view('users.show', ['user'=>$user]);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([

            'name' =>'required|max:255',
            'email' =>'required|max:255',
            'password' =>'required|max:255',
            //'blockchain_address' => 'required|'
            'blockchain_address' =>'required | max:42 | min:42' 
        ]);

        $a = new User;
        $a->name = $validatedData['name'];
        $a->email = $validatedData['email'];
        $a->password = $validatedData['password'];
        $a->save();

        $name = $a->name;

        return redirect()->route('users.index')->with('message', 'user ' .$name. ' was created');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('message', 'user ' .$name. ' was deleted');
    }

    public function profile()
    {
        $user = Auth::user();
       
        return view('admin.users.profile', ['user'=>$user]);   
     }
}
