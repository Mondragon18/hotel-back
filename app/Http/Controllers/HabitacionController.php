<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{

  public function index()
    {
        $habitaciones = Habitacion::all();
        return response()->json($habitaciones);
    }

    public function show($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return response()->json($habitacion);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo' => 'required|string|max:255',
            'costo_base' => 'required|numeric',
            'impuestos' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        $habitacion = Habitacion::create($request->all());
        return response()->json($habitacion, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo' => 'required|string|max:255',
            'costo_base' => 'required|numeric',
            'impuestos' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        $habitacion = Habitacion::findOrFail($id);
        $habitacion->update($request->all());
        return response()->json($habitacion, 200);
    }

    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();
        return response()->json(null, 204);
    }
}
