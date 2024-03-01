<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategorieImagenescontroller extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(854, 480);
        $imagenPath = public_path('categories'). '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
