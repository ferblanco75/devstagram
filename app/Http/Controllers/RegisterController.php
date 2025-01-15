<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'name' => 'required|string|max:255',
        ]);
    }

}
