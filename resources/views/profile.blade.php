@extends('layouts.app')
@section('titulo')
    Perfil: {{$user->username}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@php
    $maxCategoriesToShow = 2;
    $count = 1;
@endphp
@section('contenido')
    
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img class="w-96 m-auto rounded-full" src="{{ $user->image ? asset('profiles'. '/'. $user->image) : asset('img/usuario.svg') }}" alt="imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col justify-center">
                <div class="flex items-center gap-2">

                    <p class="text-2xl font-bold">{{$user->name}}</p>
                    
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('editProfile.index')}}" class="text-gray-500 hover:text-white">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-500">{{$user->username}}</p>
                <hr class="my-3">
                <p class="font-bold text-sm mb-3">{{$user->comments->count()}} <span class="font-normal">Comments</span></p>
                <p class="font-bold text-sm mb-3">{{$user->likes->count()}} <span class="font-normal">Favorite Videos</span></p>
                <p class="font-bold text-sm mb-3">Membership Type: <span class="font-normal">{{$user->membership->title}}</span></p>
            </div>
        </div>
    </div>

    <div class="my-5">
        <h2 class="text-3xl my-3">My Favorites</h2>

        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach ($likes as $like)
                {{-- {{dd($like->video)}} --}}
                <a href="{{route('video.show', $like->video)}}">
                    <div class="p-1 bg-stone-950 rounded-lg h-full">
                        <div>
                            <img class="rounded-tl-lg rounded-tr-lg" src="{{asset('uploads/img'. '/' . $like->video->image)}}" alt="Imagen del video: {{$like->video->title}}">
                        </div>
                        {{-- {{dd($video->video)}} --}}
                        <div class="py-3 px-5">
                            <h2 class="text-start tracking-wide text-xl truncate">{{$like->video->title}}</h2>
                            <p class="text-sm text-gray-500">
                                @foreach ($like->video->categories->take($maxCategoriesToShow) as $category)
                                    {{ $category->title }}
                                    @if (!$loop->last)
                                        {{','}}
                                    @endif
                                @endforeach
                                @if ($like->video->categories->count() > $maxCategoriesToShow)
                                    +{{ $like->video->categories->count() - $maxCategoriesToShow }}
                                @endif
                            </p>
                            <div class="flex justify-between items-center text-sm">
                                <p>{{$like->video->created_at->format('F j, Y')}}</p>
                                <p class="flex gap-2"><span><i class="fa-solid fa-eye"></i> {{$like->video->views}}</span> <span><i class="fa-solid fa-heart"></i> {{$like->video->likes->count() ?? 0}}</span></p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="container mx-auto my-6">
            {{ $likes->links('pagination::tailwind') }}
        </div>
    </div>

@endsection