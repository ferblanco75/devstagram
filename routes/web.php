<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

//este route llama a la view llamada welcome.blade
Route::get('/', function () {
    return view('principal');
});


Route::get('/register', [RegisterController::class, 'index']);

Route::post('/register', [RegisterController::class, 'store']);