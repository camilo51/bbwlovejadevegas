<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $userMembershipId = auth()->user()->membership_id;
        
            if ($userMembershipId !== 4) {
                $videos = Video::where('membership_id', '>=', $userMembershipId)->orderBy('id', 'desc')->take(8)->get();
                $updateMembership = Video::where('membership_id', '<', $userMembershipId)->orderBy('id', 'desc')->take(4)->get();
            } else {
                $videos = Video::orderBy('id', 'desc')->take(8)->get();
                $updateMembership = collect(); // Colección vacía ya que no necesitas actualizar membresías
            }
        } else {
            $videos = Video::orderBy('id', 'desc')->take(8)->get();
            $updateMembership = collect(); // Colección vacía ya que no necesitas actualizar membresías
        }

        return view('main', [
            'videos' => $videos,
            'updateMembership' => $updateMembership,
            'showViewMoreLink' => true,
        ]);
    }
}
