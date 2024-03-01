<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Memberships;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(8);

        return view('admin.videos.index', [
            'videos' => $videos
        ]);
    }

    public function create()
    {
        $categories = Categorie::all();
        $memberships = Memberships::all();

        return view('admin.videos.formulario', [
            'categories' => $categories,
            'memberships' => $memberships
        ]);
    }
    public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'required',
            'video' => 'required',
            'categories' => 'required',
            'information' => 'required|max:355',
        ]);

        $video = Video::create([
            'title' => $request->title,
            'image' => $request->image,
            'video' => $request->video,
            'information' => $request->information,
            'membership_id' => $request->membership_id
        ]);

        $video->categories()->attach($request->categories);

        return redirect()->route('dashboard.videos.index');
    }
    public function show(Video $video)
    {
        $video->increment('views');

        if (auth()->check()) {
            $userMembershipId = auth()->user()->membership_id;
            if ($userMembershipId <= $video->membership_id) {
                return view('videos.show', [
                    'video' => $video
                ]);
            }
            return redirect()->route('memberships.index');
        }
        return redirect()->route('memberships.index');
    }
    public function destroy(Video $video)
    {
        $video->delete();

        $image_path = public_path('uploads/img' . '/' . $video->image);
        $video_path = public_path('uploads/video' . '/' . $video->video);
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        if (File::exists($video_path)) {
            unlink($video_path);
        }


        return redirect()->route('dashboard.videos.index');
    }
}
