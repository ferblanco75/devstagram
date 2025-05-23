<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends \Illuminate\Routing\Controller
{
    //antes de ejecutar la funcion index y mostrar el dashboard se va a fijar que el usuario esté autenticado
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(User $user){
        return view('dashboard',[
            'user' => $user
        ]);
    } 

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required |max:255',
            'descripcion' => 'required |max:255',
        ]);
    }
}
