<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends \Illuminate\Routing\Controller

{

    public function __construct(){
    $this->middleware('auth'); // ✔️ Esto es correcto
    }


    public function index(){
        //obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray() ;
        //mostrar los posteos de los que seguimos
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
