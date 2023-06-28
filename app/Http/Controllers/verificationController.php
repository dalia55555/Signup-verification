<?php

namespace App\Http\Controllers;

use App\Http\Requests\verfiyEmailRequest;
use App\Interfaces\IUserRepo;
class verificationController extends Controller
{
    private IUserRepo $userRepository;

    public function __construct(IUserRepo $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verify_email(verfiyEmailRequest $request)
    {
        $email = $request->email;
        $verification_code = $request->verification_code;

        if($this->VerifyEmail($email, $verification_code)==false){
            return response()->json(['message' => 'error or expired'], 400);
        }
        $this->userRepository->ActivateUser($email);
        return response()->json(['message' => 'done'], 200);
    }


    private function VerifyEmail(string $email, string $verificationCode): bool
    {
       $user = $this->userRepository->getByEmail($email);
       if ($user == null) {
          return false;
       }
       $saved_code = $user->verification_code;
       if ($verificationCode != $saved_code) {
          return false;
       }
       if ($this->IsCodeExpired($user->code_send_at, 60*3)) {
          return false;
       }
       return true;
    }
    private function IsCodeExpired(string $createdAtStr, int $expiryLimit): bool
   {
      $now = strtotime(date(now()));
      $createdAt = strtotime($createdAtStr);
      $ageInSec = $now - $createdAt;
      return $ageInSec > $expiryLimit;
   }
}