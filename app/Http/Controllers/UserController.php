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
    //validate request data, case if fails, will return errors in json
    $validator = Validator::make($request->all(), [
      "name"=>'required|max:255',
      "email"=>'required|unique:users|max:255',
      "password"=>'required|min:6|max:190'
    ])->validate();

    //instantiate class
    $user = new User;
    //bind data
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    //add role to newly created user, default role id = 2 (user)
    $user->roles()->attach(2);
    $users = User::all();
    $returnView = view('adminajax')->with('users', $users)->render();
    return response()->json($returnView);
  }

  public function update(Request $request){
    if ($request->ajax()){
      $statuss = $request->input('status');
      $user = User::where("email", $request->input('email'))->first();
      $roleName = $request->input('role');
      switch ($roleName) {
        case 'role_admin':
          $roleID = 1;
          break;
        default:
          $roleID = 2;
          break;
      }
      // from unchecked to checked
      if ($statuss == "true") {
        $user->roles()->attach($roleID);
      }
      // from checked to unchecked
      else {
        $user->roles()->detach($roleID);
      }
    }
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
