<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class PublicCategoriesController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categories', [
            'categories' => $categories
        ]);
    }
    public function show(Categorie $category)
    {
        $category = Categorie::find($category->id);
        return view('categories.show', [
            'category' => $category
        ]);
    }
}
