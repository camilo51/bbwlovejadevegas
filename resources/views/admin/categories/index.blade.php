@extends('layouts.admin')

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
<div class="px-5">
    <a 
        href="{{route('dashboard.categories.create')}}" 
        class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Create Categorie</a>


    @if ($categories->count())
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

            @foreach ($categories as $categorie)
                <div class="bg-zinc-950 p-1 rounded-lg">
                    <a href="{{route('video.show', $categorie)}}" class="relative group">
                        <img src="{{asset('categories').'/'.$categorie->image}}" alt="imagen del video: {{$categorie->title}}">
                        <div class="absolute w-full h-full opacity-0 group-hover:opacity-60 bg-gray-500 top-0 left-0 flex justify-center items-center text-4xl text-white transition duration-300 rounded-tl-lg rounded-tr-lg">
                            <div>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                    </a>
                    <div class="px-3 pt-1 pb-3">
                        <p class="uppercase font-bold text-xl text-center">{{$categorie->title}}</p>
                        <div class="grid grid-cols-2 mt-2">
                            <a href="{{route('dashboard.editCategorie.index', $categorie)}}" class="w-full flex justify-center items-center hover:text-white transition duration-300 text-gray-500 md:text-lg lg:text-xl border-r-2 border-gray-600">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{route('dashboard.categories.destroy', $categorie)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="w-full flex justify-center items-center hover:text-white transition duration-300 text-gray-500 md:text-xl lg:text-2xl">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{$categories->links('pagination::tailwind')}}
        </div>
    @else
        <p class="text-xl p-10 text-center">~ There are no categories ~</p>
    @endif


</div>
@endsection