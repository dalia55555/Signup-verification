<?php

namespace App\Http\Controllers;
use App\Http\Contracts\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\VerficationCodeMail;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function Register(RegisterRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make ($request->password);
        $user->verification_code = $this->generate_verification_code(6);
        $user->save();
        $this->SendEmail($user->name,  $user->verification_code, $user->email);
        
        return response($user);
    }
    private function generate_verification_code($length):string {
        $random_hash = substr(md5(uniqid(rand(), true)), $length, $length); // 16 characters long
        return $random_hash;
    }
    private function SendEmail(string $name,string $verificationCode, $email){
        return  Mail::to($email)->send(new VerficationCodeMail($name,$verificationCode));
        }


}