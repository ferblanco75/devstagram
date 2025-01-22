<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'password' => $request->password,
        ]);
    }
}
