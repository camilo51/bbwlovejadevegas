<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Categorie;
use App\Models\Memberships;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EditVideoController extends Controller
{
    public function index(Video $video)
    {
        $categories = Categorie::all();
        $memberships = Memberships::all();
        $video = Video::find($video->id);

        return view('admin.videos.formulario', [
            'video' => $video,
            'categories' => $categories,
            'memberships' => $memberships
        ]);
    }

    public function store(Request $request, Video $video)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'categories' => 'required',
            'information' => 'required|max:355',
        ]);


        $old_image = $video->image;
        $new_image = $request->image;
        if ($old_image !== $new_image && !empty($new_image)) {
            $image_path = public_path('uploads/img' . '/' . $video->image);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }

        $old_video = $video->video;
        $new_video = $request->video;
        if ($old_video !== $new_video && !empty($new_video)) {
            $video_path = public_path('uploads/video'. '/' . $video->video );
            if(File::exists($video_path)){
                unlink($video_path);
            }
        }

        $video = Video::find($video->id);

        $video->title = $request->title;
        $video->information = $request->information;
        $video->image = $request->image ?? $video->image;
        $video->video = $request->video ?? $video->video;
        $video->membership_id = $request->membership_id;
        $video->save();
        $video->categories()->sync($request->categories);

        return redirect()->route('dashboard.videos.index');
    }
}
