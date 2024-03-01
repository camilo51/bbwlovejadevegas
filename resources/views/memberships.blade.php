@extends('layouts.app')

@section('titulo')
Categories
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://checkout.bold.co/library/boldPaymentButton.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@php
    function convertirDolaresAPesos($montoEnDolares, $tasaDeCambio = 4000)
    {
        // Redondear y multiplicar por la tasa de cambio para obtener el monto en pesos
        $montoEnPesos = round($montoEnDolares * $tasaDeCambio);

        return $montoEnPesos;
    }

    $mesesDescuento = [1 => 0, 3 => 20, 6 => 40];
@endphp
@section('contenido')
 <div class="container mx-auto">
    <div class="p-5 bg-zinc-950 mt-5">

        <div>
            @foreach ($memberships as $membership)
                <div class="rounded-md p-5
                    @if ($membership->title === 'Premium')
                        bg-indigo-600 
                    @endif
                    "
                >
                    @if ($membership->title === 'Premium')
                        <p class="text-center font-bold text-xl uppercase">Full access</p>
                    @endif
                    <h2 class="text-start my-2 text-2xl pl-5">{{$membership->title}}</h2>
                    <div class="grid grid-cols-3 gap-5 justify-items-center">

                        @foreach ($mesesDescuento as $mes => $descuento)
                        <div class="bg-zinc-900 p-5 w-5/6 rounded-xl">
                            <p class="text-center text-sm uppercase font-bold text-indigo-500">{{$mes}} @choice('month|months', $mes)</p>
                            @php
                                $precioDescuento = number_format(floatval($membership->price)*$mes -(((floatval($membership->price)*$mes)*$descuento)/100), 2);
                                $precioMes = number_format($precioDescuento / $mes, 2);
                            @endphp
                            <p class="text-center font-bold text-3xl my-5">{{$mes !== 1 ? '$'.$precioMes : $membership->price}} / <span class="text-lg">Month</span></p>
                            <p class="text-sm text-gray-500 text-center">Billed in one payment of ${{$precioDescuento}}*</p>
                            <div class="mt-5 flex justify-center">
                                @php
                                    $identificador_unico = strtolower($membership->title).'-'.$mes.'-'.str_replace('.', '', $precioDescuento);
                                    $monto_transaccion = convertirDolaresAPesos($precioDescuento);
                                    $divisa_transaccion  = "COP";
                                    $llave_secreta = env('BOLD_SECRET_KEY');
                                    $cadena_concatenada = hash("sha256", $identificador_unico.$monto_transaccion.$divisa_transaccion.$llave_secreta);
                                @endphp
                                
                                <script
                                    data-bold-button
                                    data-order-id="{{$identificador_unico}}"
                                    data-currency="{{$divisa_transaccion}}"
                                    data-amount="{{$monto_transaccion}}"
                                    data-api-key="{{env('BOLD_API_KEY')}}"
                                    data-integrity-signature="{{$cadena_concatenada}}"
                                    data-redirection-url="{{route('memberships.bold')}}"
                                    >
                                </script>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
 </div>
@endsection