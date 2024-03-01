<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Termwind\render;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $user = User::find($request->id);
        return view('admin.users.index', [
            'user' => $user
        ]);
    }

    public function destroy(User $user) 
    {
        $user->delete();
        return redirect()->route('dashboard.users.index');
    }
}
