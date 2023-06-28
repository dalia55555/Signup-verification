<?php

namespace App\Interfaces;
use App\DTO\UserDTO;
interface IUserRepo {
public function CreateUser(UserDTO $user): int;
public function getByEmail(string $email): UserDTO;
public function ActivateUser(string $email);
public function VitrifactionCodeSent(string $email);
}
?>

