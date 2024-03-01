@extends('layouts.app')

@section('titulo')
    {{$category->title}}
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
 <div class="container mx-auto">
    <div class="p-5 bg-zinc-950 mt-5">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach ($category->videos as $video)
                <a href="{{route('video.show', $video)}}">
                    <div class="p-1 bg-stone-950 rounded-lg h-full">
                        <div>
                            <img class="rounded-tl-lg rounded-tr-lg" src="{{asset('uploads/img'. '/' . $video->image)}}" alt="Imagen del video: {{$video->title}}">
                        </div>
                        <div class="py-3 px-5">
                            <h2 class="text-start tracking-wide text-xl truncate">{{$video->title}}</h2>
                            <p class="text-sm text-gray-500">
                                @foreach ($video->categories->take($maxCategoriesToShow) as $category)
                                    {{ $category->title }}
                                    @if (!$loop->last)
                                        {{','}}
                                    @endif
                                @endforeach
                                @if ($video->categories->count() > $maxCategoriesToShow)
                                    +{{ $video->categories->count() - $maxCategoriesToShow }}
                                @endif
                            </p>
                            <div class="flex justify-between items-center text-sm">
                                <p>{{$video->created_at->format('F j, Y')}}</p>
                                <p class="flex gap-2"><span><i class="fa-solid fa-eye"></i> {{$video->views}}</span> <span><i class="fa-solid fa-heart"></i> {{$video->likes->count()}}</span></p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
 </div>
@endsection