@extends('layouts.app')

@section('titulo')
    Categories
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('contenido')
 <div class="container mx-auto">
    <div class="flex justify-between items-center">
        <div class="bg-indigo-950 inline-block py-3 px-5 rounded">
            <p class="uppercase font-bold text-lg">Bbwlovejadevegas Categories</p>
        </div>
    </div>

    <div class="p-5 bg-zinc-950 mt-5">

        @if ($categories->count() >= 1)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach ($categories as $category)
                    <a href="{{route('categories.show', $category)}}">
                        <div class="p-1 bg-stone-950 rounded-lg h-full">
                            <div class="relative group">
                                <img class="rounded-lg" src="{{asset('categories/'. '/' . $category->image)}}" alt="Imagen de la categoria: {{$category->title}}">
                                <div class="w-full h-full top-0 left-0 absolute bg-black/70 flex justify-center items-center">
                                    <p class="text-2xl uppercase font-bold">{{$category->title}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="font-bold text-2xl uppercase text-center">~ There are no Videos ~</p>
        @endif

    </div>
 </div>
@endsection