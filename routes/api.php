<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoEmergenciaController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ServiciosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']); // Iniciar sesión
Route::post('register', [AuthController::class, 'register']); // Registrar un nuevo usuario


Route::group(['middleware' => 'auth:api'], function () {
  Route::get('user', [AuthController::class, 'getAuthenticatedUser']);

  Route::delete('logout', [AuthController::class, 'logout']);

  // Rutas para gestionar hoteles
  Route::get('servicios', [ServiciosController::class, 'index']); // listado un nuevo hotel

  // Rutas para gestionar hoteles
  Route::get('hoteles/{id}', [HotelController::class, 'show']); // Ver un hotel
  Route::post('hoteles', [HotelController::class, 'store']); // Crear un nuevo hotel
  Route::put('hoteles/{id}', [HotelController::class, 'update']); // Modificar un hotel existente
  Route::get('hoteles/{id}/estado/{status}', [HotelController::class, 'toggleStatus']); // Habilitar o deshabilitar un hotel
  Route::delete('hoteles/{id}', [HotelController::class, 'destroy']); // Eliminar un nuevo hotel
  
  // Rutas para gestionar habitaciones
  Route::get('habitaciones', [HabitacionController::class, 'index']); // listado de hoteles
  Route::get('habitaciones/{id}', [HabitacionController::class, 'show']); // Ver un hotel
  Route::post('habitaciones', [HabitacionController::class, 'store']); // Asignar una habitación disponible a un hotel
  Route::put('habitaciones/{id}', [HabitacionController::class, 'update']); // Modificar los valores de una habitación
  Route::get('habitaciones/{id}/estado/{status}', [HabitacionController::class, 'toggleStatus']); // Habilitar o deshabilitar una habitación
  Route::delete('habitaciones/{id}', [HabitacionController::class, 'destroy']); // Eliminar un nuevo hotel
  
  // Rutas para gestionar reservas
  Route::get('reservas', [ReservaController::class, 'index']); // Mostrar las reservas realizadas
  Route::get('reservas/{id}', [ReservaController::class, 'show']); // Mostrar el detalle de una reserva específica
  Route::post('reservas', [ReservaController::class, 'store']); // Realizar una nueva reserva
  
  
  // Rutas para contactos emergencias
  
  //   Route::resource('conatcto_emergencia', ContactoEmergenciaController::class)->except('show');
  Route::post('pasajero', [PasajeroController::class, 'store']); // Realizar una nueva reserva
  Route::post('conatcto_emergencia', [ContactoEmergenciaController::class, 'store']); // Realizar una nueva reserva
  
});

Route::get('hoteles', [HotelController::class, 'index']); // listado de hoteles
Route::get('hoteles/{id}/habitaciones', [HabitacionController::class, 'showIdHotel']); // Ver un hotel
