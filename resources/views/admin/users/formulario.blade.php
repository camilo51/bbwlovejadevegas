@extends('layouts.admin')

@section('titulo')
    Edit User
@endsection
@section('contenido')
<div class="px-5">
    <a 
    href="{{route('dashboard.users.index')}}" 
    class="bg-blue-700 hover:bg-blue-900 transition duration-300 px-5 py-3 rounded-md font-bold tracking-wide inline-block"
    >Go Back</a>
    <div class="bg-zinc-950 p-10 mx-auto rounded-lg gap-10 mt-5 w-1/2">
        <form class="text-black" action="{{route('dashboard.editUsers.store', $user)}}" method="POST">
            @csrf                
            <fieldset>
                <legend class="font-bold text-xl text-white uppercase mb-3">Profile</legend>
                <div class="ml-2">
                    <div class="mb-5">
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Name</label>
                        <input type="text" id="name" name="name" placeholder="Jade Vegas" class="p-3 w-full rounded-lg"
                        value="{{isset($user) ? $user->name : old('name')}}"
                        disabled
                        >
                    </div>
                    <div class="mb-5">
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                        <input type="text" id="username" name="username" placeholder="jade_vegas69" class="p-3 w-full rounded-lg"
                        value="{{isset($user) ? $user->username : old('username')}}"
                        disabled
                        >
                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@example.com" class="p-3 w-full rounded-lg"
                        value="{{isset($user) ? $user->email : old('email')}}"
                        disabled
                        >
                    </div>
                </div>
            </fieldset>
            
            <fieldset>
                <legend class="font-bold text-xl text-white uppercase pt-5 mb-3">Membership</legend>
                <div class="ml-2">
                    <div class="mb-5">
                        <label for="membership_id" class="mb-2 block uppercase text-gray-500 font-bold">Membership</label>
                        <select name="membership_id" id="membership_id" class="border p-3 w-full rounded-lg">
                            @foreach ($memberships as $membership) 
                                <option value="{{$membership->id}}"{{$user->membership && $user->membership->id === $membership->id ? 'selected' : '' }}>{{$membership->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="deadline" class="mb-2 block uppercase text-gray-500 font-bold">deadline</label>
                        <select name="deadline" id="deadline" class="border p-3 w-full rounded-lg">
                            <option value="1">1 Month</option>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <input 
                type="submit" 
                value="Update Data" 
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            >
        </form>
    </div>
</div>
@endsection