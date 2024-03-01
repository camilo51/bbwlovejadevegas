<?php

namespace App\Http\Controllers;

use App\Models\Memberships;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EditUsersController extends Controller
{
    public function index(User $user)
    {
        $memberships = Memberships::all();
        $user = User::find($user->id);
        return view('admin.users.formulario', [
            'user' => $user,
            'memberships' => $memberships
        ]);
    }
    public function store(Request $request, User $user)
    {
        $fechaActual = Carbon::now();
        $fechaLimite = $fechaActual->addMonth(intval($request->deadline));

        $user = User::find($user->id);

        $user->membership_id = $request->membership_id;
        $user->expiration_date = $fechaLimite;

        $user->save();

        return redirect()->route('dashboard.users.index');
    }
}
