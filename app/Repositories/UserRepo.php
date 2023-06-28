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
public function ActivateUser(int $userId): bool{
    throw new BadMethodCallException();
}
public function GetUserById(int $userId): UserDTO{
   throw new BadMethodCallException();
}
}

?>
