<?php 
namespace App\Services;

use App\Interfaces\IUserRepo;
use App\Interfaces\IUserService;
use Illuminate\Support\Facades\Hash;
class UserService implements IUserService{
    private IUserRepo $_userRepo;
    public function __construct(IUserRepo $userRepo){
        $this->_userRepo = $userRepo;
    }
    public function login(string $email, string $password) :bool{

    $user = $this->_userRepo->getByEmail($email);

    if ($user == null) {
        return false;
    }

    if(!Hash::check($password, $user->password)){
        return false;
    }
    if ($user->email_verified_at == null) {
        return false;
    }
    return true;
    }
}
?>