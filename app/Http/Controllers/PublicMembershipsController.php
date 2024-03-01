<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Memberships;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PublicMembershipsController extends Controller
{
    public function index()
    {
        $memberships = Memberships::all()->take(3);

        return view('memberships', [
            'memberships' => $memberships
        ]);
    }
    public function boldCallback(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $boldOrderId = $request->input('bold-order-id');
        $transactionStatus = $request->input('bold-tx-status');

        $redirectionStates = ['rejected', 'failed'];
        if (in_array($transactionStatus, $redirectionStates)) {
            return redirect()->route('memberships.index');
        }

        // Estado aprobado
        if ($transactionStatus === 'approved') {
            // Obtener información del boldOrderId
            list($tipo, $plazo, $precio) = explode('-', $boldOrderId);

            // Calcular la fecha de vencimiento
            $fechaLimite = Carbon::now()->addMonths(intval($plazo));

            // Mapeo de tipos a IDs de membresía
            $tiposMembresia = [
                'premium' => 1,
                'standard' => 2,
                'basic' => 3,
            ];

            // Asignar valores al usuario
            $user->membership_id = $tiposMembresia[$tipo];
            $user->expiration_date = $fechaLimite;
            $user->save();
    
            return redirect()->route('main');
        }

        // Estado no reconocido
        return redirect()->route('memberships.index');

        return view('bold.callback');
    }
}
