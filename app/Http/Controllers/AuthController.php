<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Pasajero;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
  public function register(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'usuario' => 'required|string|max:255|unique:users',
          // 'nombres' => 'required|string|max:255',
          // 'apellidos' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
      ]);

      if($validator->fails()){
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

      return response()->json(compact('user','token'),201);
  }

  public function login(Request $request)
  {
      $credentials = $request->only('email', 'password');

      try {
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 400);
          }
      } catch (JWTException $e) {
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      return response()->json(compact('token'));
  }

  public function logout(Request $request)
  {
      $this->validate($request, ['token' => 'required']);

      try {
          JWTAuth::invalidate($request->token);
          return response()->json(['success' => 'User logged out successfully']);
      } catch (JWTException $e) {
          return response()->json(['error' => 'Failed to logout, please try again.'], 500);
      }
  }

  public function getAuthenticatedUser()
  {
      try {
          if (! $user = JWTAuth::parseToken()->authenticate()) {
              return response()->json(['user_not_found'], 404);
          }
      } catch (JWTException $e) {
          return response()->json(['token_absent']);
      }

      return response()->json(compact('user'));
  }
}
