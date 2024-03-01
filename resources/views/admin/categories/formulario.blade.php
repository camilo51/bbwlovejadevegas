@extends('layouts.admin')

@section('titulo')
{{isset($categorie) ? 'Update Categorie' : 'Create Categorie'}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @vite('resources/js/dropzone-categories.js')
@endpush

@section('contenido')
<div class="px-5">
    <a 
    href="{{route('dashboard.categories.index')}}" 
    class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Go Back</a>
    <div class="bg-zinc-950 p-10 mx-auto rounded-lg grid grid-cols-1 md:grid-cols-2 gap-10 mt-5">
        <form 
            action="{{route('categories.imagenes.store')}}" 
            method="POST"
            enctype="multipart/form-data"
            class="dropzone mb-5 border-dashed border-2 rounded h-56 flex flex-col justify-center items-center text-black text-sm" 
            id="dropzone-imagen-categorie"
        >
            @csrf
        </form>
        <form id="form-principal" action="{{isset($categorie) ? route('dashboard.editCategorie.store', $categorie) : route('dashboard.categories.store')}}" method="POST">
            @csrf             
            <div class="mb-5">
                <input type="hidden" name="image" value="{{old('image')}}">
                @error('image')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>    
            <div class="mb-5">
                <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Blwojob" 
                    class="border p-3 w-full rounded-lg  text-black
                        @error('title')
                            border-red-500
                        @enderror"
                    value="{{isset($categorie) ? $categorie->title : old('title')}}"
                >
                @error('title')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <input type="submit" value="{{isset($categorie) ? 'Update Categorie' : 'Create Categorie'}}" class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide w-full">
        </form>
    </div>
</div>
@endsection