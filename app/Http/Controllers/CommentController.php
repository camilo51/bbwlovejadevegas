<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id,
            'comment' => $request->comment
        ]);

        return back()->with('mensaje', 'Comment made correctly.');
    }
}
