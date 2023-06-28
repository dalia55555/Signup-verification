<?php
namespace App\DTO;

use Carbon\Traits\Timestamp;

 class UserDTO{
    public string $name;
    public string $email;
    public string $password;
    public string $verification_code;
    public ?string $email_verified_at;
    public ?string $code_send_at;
    public function __construct(string $name,string $email,string $password, string $verification_code ){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->verification_code = $verification_code;
    }


}
?>