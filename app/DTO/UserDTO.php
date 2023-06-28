<?php
namespace App\DTO;
 class UserDTO{
    public string $name;
    public string $email;
    public string $password;
    public string $verification_code;
    public function __construct(string $name,string $email,string $password,  $verification_code ){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->verification_code = $verification_code;

    }


}
?>