<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

  public function index(Request $request)
  {

    $limit = $request->limit ?? 12;
    $sortType = $request->has('ascending') ? $request->input('ascending') : 'asc';

    $query = Hotel::withCount('habitaciones');
    // Filtro por nombre de hotel, ciudad, descripción, servicio
    if ($request->has('query')) {
      $search = $request->input('query');
      $query->where('nombre', 'like', "%{$search}%")
        ->orWhere('ciudad', 'like', "%{$search}%")
        ->orWhere('descripcion', 'like', "%{$search}%");
      // ->orWhere('servicio', 'like', "%{$search}%");
    }

    // Filtro por estado
    if ($request->has('activo')) {
      $activo = $request->input('activo');
      $query->where('activo', $activo);
    }

    if ($request->has('clasificacion')) {
      $clasificacion = $request->input('clasificacion');
      $query->where('clasificacion', $clasificacion);
    }


    $hoteles = $query->orderBy('created_at', 'asc')->paginate($limit);
    return response()->json($hoteles);
  }

  public function show($id)
  {
    $hotel = Hotel::with('habitaciones')->withCount('habitaciones')->findOrFail($id);
    $hotel->servicios = json_decode($hotel->servicios);
    return response()->json($hotel);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'clasificacion' => 'required',
      'email' => 'required',
      'telefono' => 'required',
      'pais' => 'required',
      'ciudad' => 'required',
      'direccion' => 'required',
      // 'imagenes' => 'nullable|array', // Cambiado a array para almacenar múltiples URLs de imágenes
    ]);

    // Guardar cada imagen en el sistema de archivos de Laravel
    //   foreach ($request->file('imagenes') as $image) {
    //     $imagePath = $image->store('images');
    //     $imageUrls[] = asset('storage/' . $imagePath); // URL completa de la imagen
    // }
    // Guarda la imagen en el sistema de archivos de Laravel


    // Crear el hotel con la URL de la imagen
    $hotel = Hotel::create([
      'nombre' => $request->nombre,
      'direccion' => $request->direccion,
      'ciudad' => $request->ciudad,
      'pais' => $request->pais,
      'telefono' => $request->telefono,
      'email' => $request->email,
      'clasificacion' => $request->clasificacion,
      'servicios' => $request->input('servicios'),
      'descripcion' => $request->input('descripcion'),
      'fecha_apertura' => $request->input('fecha_apertura'),
      'pagina_web' => $request->input('pagina_web'),
      // 'imagenes' => $imageUrls,
      'activo' => true, // URL completa de la imagen
    ]);

    return response()->json($hotel, 201);
    // Verificar si se proporcionaron imágenes
    // if ($request->hasFile('imagenes')) {
    //     $imageUrls = [];


    //   } else {
    //     // No se proporcionaron imágenes
    //     return response()->json(['error' => 'No se proporcionaron imágenes'], 400);
    // }
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nombre' => 'required|string|max:255',
      'clasificacion' => 'required',
      'email' => 'required',
      'telefono' => 'required',
      'pais' => 'required',
      'ciudad' => 'required',
      'direccion' => 'required',
    ]);

    $hotel = Hotel::findOrFail($id);
    $hotel->update($request->all());
    return response()->json($hotel, 200);
  }

  public function destroy($id)
  {
    $hotel = Hotel::findOrFail($id);
    $hotel->delete();
    return response()->json(null, 204);
  }

  // Método para habilitar o deshabilitar un hotel
  public function toggleStatus($id, $status)
  {
    $hotel = Hotel::findOrFail($id);
    $hotel->update(['activo' => $status]);
    return $hotel;
  }
}
