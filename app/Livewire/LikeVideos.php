<?php

namespace App\Livewire;

use Livewire\Component;

class LikeVideos extends Component
{

    public $video;
    public $isLiked;
    public $likes ;

    public function mount($video){
        $this->isLiked = $video->checkLike(auth()->user());
        $this->likes = $video->likes->count();
    }

    public function like(){
        if ($this->video->checkLike(auth()->user())){
            $this->video->likes()->where('video_id', $this->video->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->video->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-videos');
    }
}
