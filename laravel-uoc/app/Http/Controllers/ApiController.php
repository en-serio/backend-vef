<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\TransferZona;
use App\Models\TransferReservas;
use App\Models\TransferHotel;

class ApiController extends Controller
{
    public function getTransfers(Request $request) {
        Log::info($request);
          // Log para verificar los valores

        $apikey = config('services.estadistica.api_key');
        if (trim($request->get('API_KEY')) != trim($apikey)) {
            return response()->json([
                'message' => 'Nop',
                'status' => 'error',
            ], 401);
        }
        
        $result = [];
        $totalReservas = TransferReservas::count();
        $zonas = TransferZona::all();

        foreach ($zonas as $zona) {
            $hoteles = TransferHotel::where('id_zona', $zona->id_zona)->get();
            $hotelesIds = $hoteles->pluck('id_hotel');
            $trXZona= TransferReservas::whereIn('id_hotel', $hotelesIds)->count();
            $zonaData = [
                'zona' => $zona->descripcion,
                'transfer' => $trXZona,
                'porcent' => $trXZona > 0 ? ($trXZona / $totalReservas) * 100 : 0,
                'hoteles' => [],
            ];

            $reservasPorHotel = TransferReservas::whereIn('id_hotel', $hotelesIds)
                ->groupBy('id_hotel')
                ->selectRaw('id_hotel, count(*) as total_reservas')
                ->get();

            foreach ($hoteles as $hotel) {
                $hotelReserva = $reservasPorHotel->firstWhere('id_hotel', $hotel->id_hotel);
                $transfersCount = $hotelReserva ? $hotelReserva->total_reservas : 0;

                $zonaData['hoteles'][] = [
                    'hotel' => $hotel->nombre_hotel,
                    'transfer' => $transfersCount,
                    'porcent' => $transfersCount > 0 ? ($transfersCount / $trXZona) * 100 : 0,
                    'porcentTotal' => $transfersCount > 0 ? ($transfersCount / $totalReservas) * 100 : 0,
                ];
            }

            $result[] = $zonaData;
        }

        $responseData = [
            'transferTotal' => $totalReservas,
            'zonas' => $result,
        ];

        return response()->json($responseData);
    }
    
}
