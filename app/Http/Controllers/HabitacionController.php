<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{

    public function index()
    {
        $sortType = request()->has('ascending') && request()->input('ascending') == 1 ? 'asc' : 'desc';
        $search = request('search');
        $limite = Request('limite') ?? 10;

        $query = Habitacion::query();
        if (!empty($search)) {
            $query->where(function ($queryBuilder) use ($search) {
                $queryBuilder->where('tipo', 'like', "%{$search}%");
                    // ->orWhere('slug', 'like', "%{$search}%")
                    // ->orWhere('titulo', 'like', "%{$search}%");
            });
        }

        if (request()->has("orderBy")) {
            $query->orderBy(request('orderBy'), $sortType);
        }

        $data = $query->paginate($limite, ['*'], Request('page') ?? 1); // Cambié el valor predeterminado a 12 para la paginación
        return response()->json($data);
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

    // Método para habilitar o deshabilitar un hotel
    public function toggleStatus($id, $status)
    {
        $hotel = Habitacion::findOrFail($id);
        $hotel->update(['activo' => $status]);
        return $hotel;
    }
}
