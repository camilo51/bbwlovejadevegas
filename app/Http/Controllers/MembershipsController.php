<?php

namespace App\Http\Controllers;

use App\Models\Memberships;
use Illuminate\Http\Request;

class MembershipsController extends Controller
{
    public function index()
    {
        $memberships = Memberships::orderBy('price', 'asc')->get();
        return view('admin.memberships.index', [
            'memberships' => $memberships
        ]);
    }
    public function create()
    {
        return view('admin.memberships.formulario');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required'
        ]);

        Memberships::create([
            'title' => $request->title,
            'price' => $request->price
        ]);

        return redirect()->route('dashboard.memberships.index');
    }

    public function destroy(Memberships $membership)
    {
        $membership->delete();

        return back();
    }

}
