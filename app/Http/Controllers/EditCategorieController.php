<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EditCategorieController extends Controller
{
    public function index(Categorie $categorie)
    {
        $categorie = Categorie::find($categorie->id);

        return view('admin.categories.formulario',[
            'categorie' => $categorie
        ]);
    }
    public function store(Request $request, Categorie $categorie) 
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $old_image = $categorie->image;
        $new_image = $request->image;
        if ($old_image !== $new_image && !empty($new_image)) {
            $image_path = public_path('categories' . '/' . $categorie->image);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }
    
        $categorie = Categorie::find($categorie->id);

        $categorie->title = $request->title;
        $categorie->image = $request->image ?? $categorie->image;
        $categorie->save();

        return redirect()->route('dashboard.categories.index');
    }
}
