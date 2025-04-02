<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 



class ImagenController extends Controller
{
    public function store(Request $request){
                // Obtiene el archivo de imagen
        $imagen = $request->file('file');

                // Genera un nombre único para la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->getClientOriginalExtension();
        
      // Crear instancia del ImageManager
        $manager = new ImageManager(new Driver()); 
        $imagenServidor = $manager->read($imagen);

        // Redimensionar la imagen a 1000x1000
        $imagenServidor->cover(1000, 1000);

        // Verificar si la carpeta 'uploads' existe, si no, la crea
        $rutaUploads = public_path('uploads');
        if (!file_exists($rutaUploads)) {
            mkdir($rutaUploads, 0777, true);
        }

        // Guardar la imagen
        $imagenPath = $rutaUploads . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }                                           
}
