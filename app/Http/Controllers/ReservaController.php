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
        $sortType = $request->has('ascending') ? ($request->input('ascending') == 1 ? 'asc' : 'desc') : 'asc';
        $search = $request->input("query");

        $query = Reservas::with(['habitacion', 'pasajero', 'contactoEmergencia']);

        // Lógica de búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('habitacion', function($q) use ($search) {
                $q->where('tipo', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
            })
            ->orWhereHas('pasajero', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%");
            })
            ->orWhereHas('contactoEmergencia', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%");
            });
        }

        // Paginación
        $reservas = $query->orderBy($orderBy, $sortType)->paginate($limit);
        return response()->json($reservas);
    }

    public function show($id)
    {
        $reserva = Reservas::findOrFail($id);
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
