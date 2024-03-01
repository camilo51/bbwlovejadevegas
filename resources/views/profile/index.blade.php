@extends('layouts.app')

@section('titulo')
    Edit Profile: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-zinc-950 shadow-lg p-6">
            <form action="{{route('editProfile.store')}}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Name</label>
                    <input type="text" id="name" name="name" placeholder="Jade Vegas" class="border p-3 w-full rounded-lg text-black
                    @error('name')
                        border-red-500
                    @enderror"
                    value="{{auth()->user()->name}}"
                    >
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="jade-vegas69" class="border p-3 w-full rounded-lg text-black
                    @error('username')
                        border-red-500
                    @enderror"
                    value="{{auth()->user()->username}}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Profile Picture</label>
                    <input type="file" id="image" name="image" class="border p-3 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png"
                    >
                </div>
                
                <input 
                    type="submit" 
                    value="Save Changes" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection