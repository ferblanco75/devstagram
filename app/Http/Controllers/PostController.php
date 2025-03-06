<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends \Illuminate\Routing\Controller
{
    //antes de ejecutar la funcion index y mostrar el dashboard se va a fijar que el usuario esté autenticado
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard');
    }
}
