<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;

//este route llama a la view llamada welcome.blade
Route::get('/', HomeController::class)->name('home');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
//la ruta de abajo está asociada a un objeto/modelo
//hace automaticamente la asociación
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');   

Route::post('/{user:username}/posts/{post}' , [ComentarioController::class, 'store'])->name('comentarios.store');

Route::get('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');
Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

//agrego ruteo para ver un posteo

//like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
    
Route::get('/{user:username}/posts/{post}' , [PostController::class, 'show'])->name('posts.show');

//siguiendo a usuario
Route::post('/{user:username}/follow' , [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow' , [FollowerController::class, 'destroy'])->name('users.unfollow');




