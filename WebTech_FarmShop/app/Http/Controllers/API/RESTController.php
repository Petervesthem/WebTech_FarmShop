<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RESTController extends Controller
{
    public function findAllUsers(){
        try {
            $allUsers = User::all();
            return response()->json(['users'=>$allUsers]);
        } catch (Exception $exception){
            return response()->json(['error'=> 'No users to be found'], 404);
        }

    }

    public function showSpecificUser($id)
    {
        try {
            $user = User::findorFail($id);

            return response()->json(['user'=>$user], 200);
        } catch (Exception $exception){
            return response()->json(['error' =>'User not found'], 404);
        }
    }

    public function storeUser(Request $request)
    {
        try {
            $validatedUserData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'password' => 'required|string|max:255',

            ]);

            $user = User::create($validatedUserData);
            return response()->json(['data'=>$user], 201); //request has successfully led to creating user
        } catch (Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function updateUser(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id);

            $validatedUserData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'password' => 'required|string|max:255',

            ]);

            $user->update($validatedUserData);
            return response()->json(['data'=>$user], 200);
        } catch (Exception $e){
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function deleteUserByID($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
