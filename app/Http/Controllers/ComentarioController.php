<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){
        //validar

        $validatedData = $request->validate([
            'comentario' => 'required|max:255'     
        ]);


        //guardar en base
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //devolver un mensaje
        return back()->with('mensaje','comentario creado correctamente');
    }
}
