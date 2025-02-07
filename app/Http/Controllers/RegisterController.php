<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }
    //elimina un registro
    public function store(Request $request)
    {
        //dd($request->get('name'));
        //dd($request);  
        //modifico el request
        $request->request->add(['username' => Str::slug($request->username)]);
        //Validaciones en laravel
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed'            
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('posts.index');
    }
}
