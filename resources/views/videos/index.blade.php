@extends('layouts.app')

@section('titulo')
    Videos
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('contenido')
 <div class="container mx-auto">
    <div class="mb-10">
        <div class="flex justify-between items-center">
            <div class="bg-indigo-950 inline-block py-3 px-5 rounded">
                <p class="uppercase font-bold text-lg">Bbwlovejadevegas Videos</p>
            </div>
        </div>
    
        <div class="p-5 bg-zinc-950 mt-5">
            <x-listar-video :videos="$videos" :showViewMoreLink="false" :paginate="$paginate"/>

        </div>
    </div>

    
    @if ($updateMembership->isNotEmpty())
        <div class="mb-10">
            <div class="flex justify-between items-center">
                <div class="bg-indigo-950 inline-block py-3 px-5 rounded">
                    <p class="uppercase font-bold text-lg">Update your membership</p>
                </div>
            </div>
            <div class="p-5 bg-zinc-950 mt-5">
                <x-listar-video :videos="$updateMembership" :showViewMoreLink="false" :paginate="$paginate"/>
            </div>
        </div>
    @endif
 </div>
@endsection