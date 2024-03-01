<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class PublicVideosController extends Controller
{
    public function index()
    {
        $paginate = true;
        if (auth()->check()) {
            $userMembershipId = auth()->user()->membership_id;


            if ($userMembershipId !== 4) {
                $videos = Video::where('membership_id', '>=', $userMembershipId)->orderBy('id', 'desc')->paginate(20);
                $updateMembership = Video::where('membership_id', '<', $userMembershipId)->orderBy('id', 'desc')->get();
            } else {
                $videos = Video::orderBy('id', 'desc')->paginate(20);
                $updateMembership = collect();
            }
        } else {
            $videos = Video::orderBy('id', 'desc')->paginate(20);
            $updateMembership = collect();
        }
        return view('videos.index', [
            'videos' => $videos,
            'updateMembership' => $updateMembership,
            'paginate' => $paginate
        ]);
    }
}
