<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $orderBy = $request->has('orderBy') ? $request->input('orderBy') : 'created_at';
        $sortType = $request->has('ascending') ? $request->input('ascending') : 'asc';  

        $query = Reservas::with(['habitacion.hotel', 'pasajero.user', 'contactoEmergencia']);

        if ($request->has('fecha_entrada')) {
          $fechaEntrada = $request->input('fecha_entrada');
          $query->whereDate('fecha_entrada', $fechaEntrada);
        }
    
        if ($request->has('fecha_salida')) {
          $fechaSalida = $request->input('fecha_salida');
          $query->whereDate('fecha_salida', $fechaSalida);
        }
    
        if ($request->has('estado')) {
          $estado = $request->input('estado');
          $query->where('estado', $estado);
        }

        // Lógica de búsqueda
        if ($request->has('query')) {
            $search = $request->input('query');
            $query->whereHas('habitacion', function($q) use ($search) {
                $q->where('tipo', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
            })
            ->orWhereHas('habitacion.hotel', function($q) use ($search) {
              $q->where('nombre', 'like', "%{$search}%");
            })
            ->orWhereHas('pasajero.user', function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%");
            })
            ->orWhereHas('contactoEmergencia', function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        if($orderBy === 'habitacion.tipo'){
          $query->orderByRaw("(SELECT tipo FROM habitacion WHERE id = reservas.habitacion_id) $sortType");
        } else if ($orderBy === 'pasajero.user.nombres'){
          $query->orderByRaw("(SELECT nombres FROM users WHERE id = (SELECT user_id FROM pasajeros WHERE id = reservas.pasajero_id)) $sortType");
        } else {
            $query->orderBy($orderBy, $sortType);
        }

        // Paginación
        $reservas = $query->paginate($limit);
        return response()->json($reservas);
    }

    public function show($id)
    {
        $reserva = Reservas::with(['habitacion.hotel', 'pasajero.user', 'contactoEmergencia'])->findOrFail($id);

        $reserva->habitacion->hotel->servicios = json_decode($reserva->habitacion->hotel->servicios);
        return response()->json($reserva);
    }

    public function store(Request $request)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitacion,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
            'monto_total' => 'required|numeric',
            'estado' => 'required|string|max:255',
            'usuario_email' => 'required|string|email|max:255',
        ]);

        $reserva = Reservas::create($request->all());
        return response()->json($reserva, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitacion,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
            'monto_total' => 'required|numeric',
            'estado' => 'required|string|max:255',
            'usuario_email' => 'required|string|email|max:255',
            // Agrega las validaciones necesarias para los otros campos
        ]);

        $reserva = Reservas::findOrFail($id);
        $reserva->update($request->all());
        return response()->json($reserva, 200);
    }

    public function destroy($id)
    {
        $reserva = Reservas::findOrFail($id);
        $reserva->delete();
        return response()->json(null, 204);
    }
}
