<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{

  public function index()
  {
      $pasajeros = Pasajero::all();
      return response()->json($pasajeros);
  }

  public function show($id)
  {
      $pasajero = Pasajero::findOrFail($id);
      return response()->json($pasajero);
  }

  public function store(Request $request)
  {
      $request->validate([
          'user_id' => 'required|exists:users,id',
          'reserva_id' => 'required|exists:reservas,id',
      ]);

      $pasajero = Pasajero::create($request->all());
      return response()->json($pasajero, 201);
  }

  public function update(Request $request, $user_id)
  {
      $request->validate([
          'reserva_id' => 'required|exists:reservas,id',
      ]);

      $perfil = $request->except('user_id');

      $pasajero = Pasajero::where('user_id', $user_id)->firstOrFail();
      $pasajero->update($perfil);

      return response()->json($pasajero, 200);
  }

  public function destroy($id)
  {
      $pasajero = Pasajero::findOrFail($id);
      $pasajero->delete();
      return response()->json(null, 204);
  }
}
