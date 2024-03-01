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
        href="{{route('dashboard.memberships.create')}}" 
        class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Create Membership</a>

    
    @if ($memberships->count())
        <div class="bg-zinc-950 w-full md:h-96 p-5 mt-5">
            @foreach ($memberships as $membership)
                <div class="shadow-lg p-3 grid grid-cols-2 items-center">
                    <div class="grid grid-cols-2">
                        <p>{{$membership->title}}</p>
                        <p>${{$membership->price}}</p>
                    </div>
                    <div class="flex justify-end gap-5 items-center">
                        <a href="{{route('dashboard.editMemberships.index', $membership)}}" class="text-xl bg-blue-700 p-2 rounded-md w-16 text-center hover:bg-blue-900 hover:text-gray-400 transition duration-300">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        <form action="{{route('dashboard.memberships.destroy', $membership)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="cursor-pointer text-xl bg-red-700 p-2 rounded-md w-16 text-center hover:bg-red-900 hover:text-gray-400 transition duration-300">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-xl p-10 text-center">~ There are no Memberships ~</p>
    @endif


</div>
@endsection