<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombres' => 'required|string|max:255',
      'apellidos' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $user = User::create([
      'usuario' => $request->usuario,
      'nombres' => $request->nombres,
      'apellidos' => $request->apellidos,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'persona' => $request->persona ?? 'pasajero', // O 'agente' dependiendo de tu lógica
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json(compact('user', 'token'), 201);
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $credentials = $request->only('email', 'password');

    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => ['Credenciales no válidas']], 400);
      }

      // Obtener el usuario autenticado
      $user = auth()->user();

      // Devolver la información del usuario junto con el token
      return response()->json([
        'token' => $token,
        'user' => $user
      ]);
    } catch (JWTException $e) {
      return response()->json(['error' => ['No se pudo crear el token']], 500);
    }
  }

  public function logout(Request $request)
  {
    $token = JWTAuth::parseToken()->getToken();

    try {
      // Invalida el token
      JWTAuth::invalidate($token);

      // Devuelve el token de acceso como respuesta JSON
      return response()->json(['success' => 'El usuario cerró la sesión correctamente.']);
    } catch (JWTException $e) {
      return response()->json(['error' => 'No pudo cerrar la sesión, inténtelo de nuevo.'], 500);
    }
  }

  public function getAuthenticatedUser()
  {
    try {
      if (!$user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (JWTException $e) {
      return response()->json(['token_absent']);
    }

    return response()->json(compact('user'));
  }
}
