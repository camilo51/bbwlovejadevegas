<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $video->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }
    public function destroy(Request $request, Video $video)
    {
        $request->user()->likes()->where('video_id', $video->id)->delete();
        return back();
    }
}
