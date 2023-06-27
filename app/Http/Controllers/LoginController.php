<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function Login(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();
        if(!$user || !Hash::check($password, $user->password)){
            return response()->json(['message' => 'Wrong email or password'], 401);
        }
        if($user->email_verified_at == null){
            return response()->json(['message' => 'Please verify your email address to login'], 200);
        }
        return response()->json(['message' => 'Success login'], 200);
    }
}
