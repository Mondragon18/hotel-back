<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

  public function index()
  {
      $users = User::all();
      return response()->json($users);
  }
  
  public function show($id)
  {
      $user = User::findOrFail($id);
      return response()->json($user);
  }

  public function update(Request $request, $id)
  {
      $request->validate([
          'usuario' => 'required|string|max:255',
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users,email,'.$id,
      ]);

      $userInput = $request->except('persona');

      $user = User::findOrFail($id);
      $user->update($userInput);
      return response()->json($user, 200);
  }
}
