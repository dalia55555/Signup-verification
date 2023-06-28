<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\IUserRepo;
use App\Mail\VerficationCodeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use  App\DTO\UserDTO;


class RegistrationController extends Controller
{
    private IUserRepo $userRepo ;
    public function __construct(IUserRepo $userRepo){
        $this->userRepo = $userRepo;
    }
    public function Register(RegisterRequest $request){
        $userDTO = new UserDTO($request->name, $request->email,Hash::make ($request->password), $this->generate_verification_code(6));
        $res =  $this->userRepo->CreateUser($userDTO);
        $this->SendEmail($userDTO->name,  $userDTO->verification_code, $userDTO->email);
        return response($res);
    }
    private function generate_verification_code($length):string {
        $random_hash = substr(md5(uniqid(rand(), true)), $length, $length); // 16 characters long
        return $random_hash;
    }
    private function SendEmail(string $name,string $verificationCode, $email){
        Mail::to($email)->send(new VerficationCodeMail($name,$verificationCode));
        $this->userRepo->VitrifactionCodeSent($email);
        }


}