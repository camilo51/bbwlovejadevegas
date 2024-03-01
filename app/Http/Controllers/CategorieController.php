<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    public function index()
    {
        $categories = Categorie::orderBy('id', 'desc')->paginate(8);

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }
    public function create()
    {
        return view('admin.categories.formulario');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required'
        ]);

        Categorie::create([
            'title' => $request->title,
            'image' => $request->image
        ]); 

        return redirect()->route('dashboard.categories.index');
    }
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        $image_path = public_path('categories'. '/' . $categorie->image );

        if(File::exists($image_path)){
            unlink($image_path);
        }

        return redirect()->route('dashboard.categories.index');
    }
}
