<?php

namespace App\Http\Controllers;

use FFMpeg\FFMpeg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UploadVideosController extends Controller
{
    public function store(Request $request)
    {
        $video = $request->file('file');
        $nombreVideo = Str::uuid() . '.' . $video->extension();
        $video->move(public_path('uploads/video'), $nombreVideo);
        return response()->json(['video' => $nombreVideo]);
    }
}
