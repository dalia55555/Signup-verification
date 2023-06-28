<?php 
namespace App\Repositories;
use App\DTO\UserDTO;
use App\Interfaces\IUserRepo;
use App\Models\User;
use PHPUnit\Framework\MockObject\BadMethodCallException;


class UserRepo implements IUserRepo{
   public function CreateUser(UserDTO $userDto): int{
   $user = new User;
   $user->name = $userDto->name;
   $user->email = $userDto->email;
   $user->password = $userDto->password;
   $user->verification_code = $userDto->verification_code;
   $user->save();
      return $user->id;
   }
   public function getByEmail(string $email): UserDTO
   {
      $user = User::where('email', $email)->first();
      $userDto = new UserDTO( $user->name,  $user->email, $user->password,  $user->verification_code);
      $userDto->email_verified_at = $user->email_verified_at;
      $userDto->code_send_at = $user->code_send_at;
      return $userDto;
   }
   public function ActivateUser(string $email) :void{
   $user = User::where('email', $email)->first();
   $user->email_verified_at = date(now());
   $user->save();
   }
   public function VitrifactionCodeSent(string $email){
   $user = User::where('email', $email)->first();
   $user->code_send_at = date(now());
   $user->save();
   }
}

?>
