@extends('layouts.video')

@section('titulo')
    {{$video->title}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    @vite('resources/js/resizeVideo.js')
@endpush
{{now()}}
@section('contenido')
    <div class="md:flex gap-6">
        <div class="w-full md:w-2/3">

                <video 
                    id="my-video"
                    class="video-js w-full"
                    controls
                    preload="auto"
                    poster="{{asset('uploads/img'.'/'.$video->image)}}"
                    data-setup="{}"
                >
                    <source src="{{asset('uploads/video'.'/'.$video->video)}}" type="video/mp4" />
                </video>


            <div class="p-6">
                <div class="flex justify-between">
                    <p class="text-gray-600">{{$video->created_at->format('F j, Y')}}</p>
                    <div class="flex gap-8">
                        <div class="text-xl flex gap-4 items-center">   
                            @auth
                                <livewire:like-videos :video="$video" />
                            @endauth      
                        </div>
                        <p class="text-xl">{{$video->views}} Views</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-left text-4xl">{{$video->title}}</h2>
                </div>
                <div class="mt-10">
                    <h3 class="text-left text-gray-500">Description</h3>
                    <p class="mt-1">{{$video->information}}</p>
                </div>
            </div>

        </div>
        
        <div class="w-full md:w-1/3 p-5">
            <div class="shadow bg-zinc-950 p-5 mb-5">
                    @auth
                    <p class="text-xl font-bold text-center mb-4">Add a New Comment</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{route('comments.store', ['video' => $video])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Comment</label>
                            <textarea 
                                id="comment" 
                                name="comment" 
                                placeholder="Add new comment to the video" 
                                class="border p-3 w-full rounded-lg  text-black @error('comment')
                                border-red-500
                                @enderror"></textarea>
                                @error('comment')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                                @enderror
                        </div>
                        <input type="submit" value="Create Video" class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide w-full">
                    </form>
                @endauth

                <div class="bg-zinc-950 shadow-lg mb-5 {{ $video->comments->count() >= 5 ? 'max-h-96 overflow-y-scroll' : '' }} mt-10">
                    @if ($video->comments->count())
                        @foreach ($video->comments->reverse() as $comment)
                            <div class="p-5 border-gray-700 border-b flex gap-5 items-center">
                                <div class="w-2/12">
                                    <a href="{{route('profile.index', $comment->user)}}">
                                        <img class="rounded-full" src="{{$comment->user->image ? asset('profiles'. '/'.$comment->user->image) : asset('img/usuario.svg')}}" alt="imagen de prefil de: {{$comment->user->username}}">
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('profile.index', $comment->user)}}" class="font-bold">{{$comment->user->username}}</a>
                                    <p class="text-sm text-gray-500">{{$comment->created_at->diffForHumans()}}</p>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-gray-500">~ There are no comments ~</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
