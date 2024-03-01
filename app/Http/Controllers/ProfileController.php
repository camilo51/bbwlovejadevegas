<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $likes = $user->likes()->paginate(8);

        return view('profile', [
            'user' => $user,
            'likes' => $likes,
        ]);
    }
}
