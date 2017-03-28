<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      "name"=>'required|max:255',
      "email"=>'required|unique:users|max:255',
      "password"=>'required|min:6|max:190'
    ])->validate();
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    //add role to newly created user, default role id = 2 (user)
    $user->roles()->attach(2);
    return response()->json("AllOK");
  }
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    //remove any many-to-many relationships from DB
    $user->roles()->detach();
    $user->delete();
    return;
  }
}
