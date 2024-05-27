<?php

namespace App\Http\Controllers;

use App\Mail\ReservaHotelMail;
use App\Models\ContactoEmergencia;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

      $reserva = Reservas::with('habitacion.hotel', 'pasajero.user', 'contactoEmergencia')->find($contacto->reserva_id);

      Mail::to($reserva->pasajero->user->email)->send(new ReservaHotelMail($reserva));

      return response()->json([$contacto, $reserva->pasajero->user->email] , 201);
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
