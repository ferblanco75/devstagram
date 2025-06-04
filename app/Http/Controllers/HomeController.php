<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        //obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray() ;
        //mostrar los posteos de los que seguimos
        $posts = Post::whereIn('user_id', $ids)->paginate(20);
        dd($posts);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
