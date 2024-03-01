@extends('layouts.admin')

@section('titulo')
    Users
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('contenido')
<div class="px-5">


    @if (isset($users) ? $users->count() : ($user !== null ? $user->count() : true))
        <div class="p-5 bg-zinc-950">
            <div>
                <form action="{{route('dashboard.users.search')}}" method="POST">
                    @csrf
                    <div class="flex flex-row-reverse items-center gap-1 p-5">
                        <button 
                            type="submit" 
                            class="text-xl px-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input 
                            id="id"
                            name="id"
                            type="number" 
                            placeholder="User id"
                            class="rounded py-1 px-3 w-1/2 uppercase text-black  border
                            @error('id') 
                            border-red-500 
                            @enderror"    
                        >
                    </div>
                </form>
            </div>
            <div>
                @if (isset($users))
                    @foreach ($users as $user)
                        @include('partials.users_card', ['user' => $user])
                    @endforeach
                @elseif ($user)
                    <a 
                        href="{{route('dashboard.users.index')}}" 
                        class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block mb-5"
                    >Go Back</a>
                    @include('partials.users_card', ['user' => $user])
                @else
                    <a 
                        href="{{route('dashboard.users.index')}}" 
                        class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block mb-5"
                    >Go Back</a>
                    <p class="text-xl p-5 text-center">~ No user found ~</p>
                @endif
            </div>
            
            <div class="my-10">
                {{isset($users) ? $users->links('pagination::tailwind') : '' }}
            </div>
        </div>
    @else
        <p class="text-xl p-10 text-center">~ There are no Users ~</p>
    @endif


</div>
@endsection