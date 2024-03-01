@php
    $maxCategoriesToShow = 2;
    $count = 1;
@endphp
<div>
    @if ($videos->count() >= 1)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    @foreach ($videos as $video)
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

                @if (isset($paginate) && $paginate)
                    <div class="my-10">
                        {{$videos->links('pagination::tailwind')}}
                    </div>
                @endif
                <div class="my-5 flex justify-center gap-3 items-center">
                    @if ($videos->count() === 8 && isset($showViewMoreLink) && $showViewMoreLink)
                        <a href="{{route('videos.index')}}" class="inline-block py-3 px-5 bg-blue-700 rounded">
                            View More
                        </a>
                    @endif
                    @if (!auth()->user() || auth()->user()->membership_id === 4)
                        <a href="{{route('register')}}" class="inline-block py-3 px-5 bg-yellow-700 rounded">
                            Join Now
                        </a>
                    @endif
                </div>
            @else
                <p class="font-bold text-2xl uppercase text-center">~ There are no Videos ~</p>
            @endif
</div>