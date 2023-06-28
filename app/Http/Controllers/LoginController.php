<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Interfaces\IUserRepo;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(IUserRepo $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request): JsonResponse
{
    $email = $request->email;
    $password = $request->password;

    $user = $this->userRepository->getByEmail($email);

    if ($user == null) {
        return response()->json(['message' => 'User not found'], 404);
    }

    if(!Hash::check($password, $user->password)){
        return response()->json(['message' => 'Wrong password'], 401);
    }
    if ($user->email_verified_at == null) {
        return response()->json(['message' => 'Please verify your email address to login'], 200);
    }

    return response()->json(['message' => 'Success login'], 200);
}
}