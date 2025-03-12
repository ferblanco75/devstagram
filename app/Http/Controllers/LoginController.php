<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'            
        ]);


        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
        }
        return redirect()->route('posts.index'); 
    }
}
