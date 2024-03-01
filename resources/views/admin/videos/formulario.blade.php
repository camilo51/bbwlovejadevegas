@extends('layouts.admin')

@section('titulo')
    {{isset($video) ? 'Update Video' : 'Create Video'}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @vite('resources/js/dropzone-videos.js')
@endpush

@section('contenido')

<div class="px-5">
    <a 
    href="{{route('dashboard.videos.index')}}" 
    class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Go Back</a>
    <div class="bg-zinc-950 p-10 w-1/2 mx-auto rounded-lg">
        <div class="flex gap-5 m-auto">
            <form 
                action="{{route('imagenes.store')}}" 
                method="POST"
                enctype="multipart/form-data"
                class="dropzone mb-5 border-dashed border-2 rounded w-2/4 h-56 flex flex-col justify-center items-center text-black text-sm" 
                id="dropzone-imagen"
            >
                @csrf
            </form>
            <form 
                action="{{route('videos.store')}}" 
                method="POST"
                enctype="multipart/form-data"
                class="dropzone mb-5 border-dashed border-2 rounded w-2/4 h-56 flex flex-col justify-center items-center text-black text-sm" 
                id="dropzone-video"
            >
                @csrf
            </form>

        </div>
        <form class=" m-auto" id="form-principal" action="{{isset($video) ? route('dashboard.editVideo.store', $video) : route('dashboard.videos.store')}}" method="POST">
            @csrf             
            <div class="mb-5">
                <input type="hidden" name="image" value="{{old('image')}}">
                @error('image')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>                 
            <div class="mb-5">
                <input type="hidden" name="video" value="{{old('video')}}">
                @error('video')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div> 
            <div class="mb-5">
                <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Jade Vegas" 
                    class="border p-3 w-full rounded-lg  text-black
                        @error('title')
                            border-red-500
                        @enderror"
                    value="{{isset($video) ? $video->title : old('title')}}"
                >
                @error('title')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="categories" class="mb-2 block uppercase text-gray-500 font-bold">Categories</label>
                <select 
                    type="text" 
                    id="categories" 
                    name="categories[]" 
                    class="border p-3 w-full rounded-lg  text-black @error('categories') border-red-500 @enderror"
                    multiple
                >
                    @if (!isset($video))
                        @foreach ($categories as $categorie)
                            <option value="{{$categorie->id}}" {{ in_array($categorie->id, old('categories', [])) ? 'selected' : '' }}>{{$categorie->title}}</option>
                        @endforeach
                    @else
                        @foreach ($categories as $categorie)
                            <option value="{{$categorie->id}}" {{ $video->categories->contains('id', $categorie->id) ? 'selected' : '' }}>{{$categorie->title}}</option>
                        @endforeach
                    @endif
                </select>
                @error('categories')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="membership_id" class="mb-2 block uppercase text-gray-500 font-bold">Membership Required</label>
                <select 
                    type="text" 
                    id="membership_id" 
                    name="membership_id" 
                    class="border p-3 w-full rounded-lg  text-black"
                >
                    @if (!isset($video))
                        @foreach ($memberships as $membership)
                            <option value="{{$membership->id}}" {{old('membership_id') == $membership->id ? 'selected' : ''}}>{{$membership->title}}</option>
                        @endforeach
                    @else
                        @foreach ($memberships as $membership)
                            <option value="{{$membership->id}}" {{$video->membership_id=== $membership->id  ? 'selected' : ''}}>{{$membership->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="mb-5">
                <label for="information" class="mb-2 block uppercase text-gray-500 font-bold">Information</label>
                <textarea 
                    id="information" 
                    name="information" 
                    placeholder="Information for the video" 
                    class="border p-3 w-full rounded-lg  text-black @error('information')
                            border-red-500
                        @enderror">{{isset($video) ? $video->information : old('information')}}</textarea>
                @error('information')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
           
            <input type="submit" value="{{isset($video) ? 'Update Video' : 'Create Video'}}" class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide w-full">
        </form>
    </div>
</div>
@endsection