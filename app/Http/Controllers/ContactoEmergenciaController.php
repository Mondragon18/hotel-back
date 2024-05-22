<?php

namespace App\Http\Controllers;

use App\Models\ContactoEmergencia;
use Illuminate\Http\Request;

class ContactoEmergenciaController extends Controller
{

  public function index()
  {
      $contactos = ContactoEmergencia::all();
      return response()->json($contactos);
  }

  public function show($id)
  {
      $contacto = ContactoEmergencia::findOrFail($id);
      return response()->json($contacto);
  }

  public function store(Request $request)
  {
      $request->validate([
          'reserva_id' => 'required|exists:reservas,id',
          'nombres' => 'required|string|max:255',
          'telefono' => 'required|string|max:255',
      ]);

      $contacto = ContactoEmergencia::create($request->all());
      return response()->json($contacto, 201);
  }

  public function update(Request $request, $id)
  {
      $request->validate([
          'reserva_id' => 'required|exists:reservas,id',
          'nombres' => 'required|string|max:255',
          'telefono' => 'required|string|max:255',
      ]);

      $contacto = ContactoEmergencia::findOrFail($id);
      $contacto->update($request->all());
      return response()->json($contacto, 200);
  }

  public function destroy($id)
  {
      $contacto = ContactoEmergencia::findOrFail($id);
      $contacto->delete();
      return response()->json(null, 204);
  }
}
