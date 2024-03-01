@extends('layouts.admin')

@section('titulo')
{{isset($membership) ? 'Update Membership' : 'Create Membership'}}
@endsection


@section('contenido')
<div class="px-5">
    <a 
    href="{{route('dashboard.memberships.index')}}" 
    class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Go Back</a>
    <div class="bg-zinc-950 p-10 mx-auto rounded-lg gap-10 mt-5 w-1/2">
        <form action="{{isset($membership) ? route('dashboard.editMemberships.store', $membership) : route('dashboard.memberships.store')}}" method="POST">
            @csrf             
            <div class="mb-5">
                <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Premium" 
                    class="border p-3 w-full rounded-lg  text-black
                        @error('title')
                            border-red-500
                        @enderror"
                    value="{{isset($membership) ? $membership->title : old('title')}}"
                >
                @error('title')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="price" class="mb-2 block uppercase text-gray-500 font-bold">Price</label>
                <input 
                    type="text" 
                    id="price" 
                    name="price" 
                    placeholder="$32.99" 
                    class="border p-3 w-full rounded-lg  text-black
                        @error('price')
                            border-red-500
                        @enderror"
                    value="{{isset($membership) ? $membership->price : old('price')}}"
                >
                @error('price')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <input type="submit" value="{{isset($membership) ? 'Update Membership' : 'Create Membership'}}" class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide w-full">
        </form>
    </div>
</div>
@endsection