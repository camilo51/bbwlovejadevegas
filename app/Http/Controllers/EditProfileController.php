<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }
    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20'],
        ]);
        if ($request->image) {
            $imagen = $request->file('image');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(800, 800);
            $imagenPath = public_path('profiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $user = User::find(auth()->user()->id);
        
        $user->name = $request->name;
        $user->username = $request->username;
        $user->image = $nombreImagen ?? auth()->user()->image ?? null;

        $user->save();

        return redirect()->route('profile.index', $user->username);
    }
}
