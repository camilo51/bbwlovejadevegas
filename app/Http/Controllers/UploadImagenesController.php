<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UploadImagenesController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(854, 480);
        $imagenPath = public_path('uploads/img'). '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
