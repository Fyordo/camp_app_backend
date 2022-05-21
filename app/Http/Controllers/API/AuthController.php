<?php

namespace App\Http\Controllers\API;

use App\Classes\UserClass;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        $phone = request()->phone;

        if ($phone){
            $user = User::where('phone', '=', $phone)->first();
            if ($user){
                return response()->json(new UserClass($user->toArray()));
            }
            else{
                return response()->json(['status' => "User not found"], 404);
            }
        }
        else{
            return response()->json(['status' => "Incorrect request body"], 403);
        }
    }
}
