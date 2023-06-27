<?php

namespace App\Http\Controllers;

use App\Http\Requests\verfiyEmailRequest;
use Illuminate\Http\Request;
use App\Models\user;
class verificationController extends Controller
{
    public function verify_email(verfiyEmailRequest $request)
{
    $email = $request->email;
    $verification_code = $request->verification_code;

    
    $user = User::where('email','=', $email)->first();
    if(!$user){
        return response()->json(['message' => 'User not found'],404);
    }
    if($user->email_verified_at != null){ return response()->json(['message' => 'already verified'],400);}
    $saved_code = $user->verification_code;
    if($verification_code != $saved_code){
        return response()->json(['message' => 'wrong code'],400);
    }
    $user->email_verified_at = date(now());
    $user->save();
    return response()->json(['message' => 'Done'],200);
}
}