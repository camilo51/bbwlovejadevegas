<div class="shadow-lg p-3 grid grid-cols-2 items-center">
    <div class="grid grid-cols-12">
        <div class="row-start-1 row-end-3 flex justify-center items-center">
            <p>
                {{$user->id}}
            </p>
        </div>
        <div class="col-start-2 col-end-7">
            <p>{{$user->name}}</p>
            <p>{{$user->email}}</p>
        </div>
        <div class="col-start-7 col-end-12">
            <p>{{$user->username}}</p>
            <p>{{$user->membership->title}}</p>
        </div>
    </div>
    <div class="flex justify-end gap-5 items-center">
        <a href="{{route('dashboard.editUsers.index', $user)}}" class="text-xl bg-blue-700 p-2 rounded-md w-16 text-center hover:bg-blue-900 hover:text-gray-400 transition duration-300">
            <i class="fa-solid fa-pencil"></i>
        </a>

        <form action="{{route('dashboard.users.destroy', $user)}}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="cursor-pointer text-xl bg-red-700 p-2 rounded-md w-16 text-center hover:bg-red-900 hover:text-gray-400 transition duration-300">
                <i class="fa-solid fa-x"></i>
            </button>
        </form>
    </div>
</div>