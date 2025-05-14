<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;


class PostController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests;
    //antes de ejecutar la funcion index y mostrar el dashboard se va a fijar que el usuario esté autenticado
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){
        $posts = Post::where('user_id', $user->id)->simplePaginate(20); 

        return view('dashboard',[
            'user' => $user,
            'posts'=> $posts
        ]);
    } 

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'titulo' => 'required |max:255',
            'descripcion' => 'required',
            'imagen' => 'required',          
        ]);
        
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,  
        //     'user_id' => auth()->user()->id,          
        // ]);

        $request->user()->posts()->create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,  
                'user_id' => auth()->user()->id,          
        ]);
        
        return redirect()->route('posts.index', auth()->user()->username); 
    }

    public function show(User $user, Post $post){
        $post->load('comentarios.user');

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){
       $this->authorize('delete', $post);
       $post->delete();
       //elimino la imagen
       $imagen_path = public_path('uploads/' . $post->imagen);

       if(File::exists($imagen_path)) {
            unlink($imagen_path);
       } 
        
       return redirect()->route('posts.index', auth()->user()->username);
    }
}
