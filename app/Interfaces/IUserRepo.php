<?php

namespace App\Interfaces;
use App\DTO\UserDTO;
interface IUserRepo {
public function CreateUser(UserDTO $user): int;
public function ActivateUser(int $userId): bool;
public function GetUserById(int $userId): UserDTO;

}


?>

