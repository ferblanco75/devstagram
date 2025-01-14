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
    public function store()
    {
        dd('Post...');        
    }

}
