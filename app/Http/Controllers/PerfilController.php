<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PerfilController extends \Illuminate\Routing\Controller
{
    
    use AuthorizesRequests;

    public function __construct(){
        $this->middleware('auth');
    }
    
    
    public function index(){
        return view('perfil.index');
    }
}
