<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;
use App\Models\Post;

class PerfilController extends \Illuminate\Routing\Controller
{
    
    use AuthorizesRequests;

    public function __construct(){
        $this->middleware('auth');
    }
    
    
    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);

        $validateData = $request->validate([
            'username' => ['required','unique:users','min:3','max:20','not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen) {
           $imagen = $request->file('imagen');
                // Genera un nombre único para la imagen
            $nombreImagen = Str::uuid() . '.' . $imagen->getClientOriginalExtension();          
        // Crear instancia del ImageManager
            $manager = new ImageManager(new Driver()); 
            $imagenServidor = $manager->read($imagen);

            // Redimensionar la imagen a 1000x1000
            $imagenServidor->cover(1000, 1000);
            // Verificar si la carpeta 'uploads' existe, si no, la crea
            $rutaUploads = public_path('perfiles');
            if (!file_exists($rutaUploads)) {
                mkdir($rutaUploads, 0777, true);
            }

            // Guardar la imagen
            $imagenPath = $rutaUploads . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        //guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();
        //redirect al muro
        return redirect()->route('posts.index', $usuario->username);
    }
}
