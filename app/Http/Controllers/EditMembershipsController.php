<?php

namespace App\Http\Controllers;

use App\Models\Memberships;
use Illuminate\Http\Request;

class EditMembershipsController extends Controller
{
    public function index(Memberships $membership)
    {
        $membership = Memberships::find($membership->id);

        return view('admin.memberships.formulario',[
            'membership' => $membership
        ]);
    }
    public function store(Request $request, Memberships $membership)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required'
        ]);

        $membership = Memberships::find($membership->id);

        $membership->title = $request->title;
        $membership->price = $request->price;
        $membership->save();
    
        return redirect()->route('dashboard.memberships.index');
    }
}
