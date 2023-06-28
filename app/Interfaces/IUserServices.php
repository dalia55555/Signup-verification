<?php
namespace App\Interfaces;
interface IUserService{
public function login(string $email, string $password) :bool;
}
?>