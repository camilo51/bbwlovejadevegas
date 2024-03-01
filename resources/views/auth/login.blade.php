@extends('layouts.app')

@section('titulo')
    Log in
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-4 md:items-center">
        <div class="md:w-1/2 lg:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>
        <div class="md:w-1/2 lg:w-4/12 bg-zinc-950 p-6 rounded-lg">
            <form class="text-black" action="{{route('login')}}" method="POST">
                @csrf                
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@example.com" class="border p-3 w-full rounded-lg
                    @error('email')
                        border-red-500
                    @enderror"
                    value="{{old('email')}}"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="*********" class="border p-3 w-full rounded-lg
                    @error('password')
                        border-red-500
                    @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class="ml-2 text-sm uppercase text-gray-500 font-bold">keep my session open</label>
                </div>

                <input 
                    type="submit" 
                    value="Log In" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection