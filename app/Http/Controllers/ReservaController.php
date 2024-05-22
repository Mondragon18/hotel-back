<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
  public function index()
    {
        $reservas = Reservas::all();
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
            // Agrega las validaciones necesarias para los otros campos
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
