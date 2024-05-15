<?php
namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function create(UserDTO $userDTO) : User
    {
        $user = $this->userRepository->create([
            'email' => $userDTO->email,
            'name' => $userDTO->name,
            'password' => bcrypt($userDTO->password),
        ]);

        return $user;
    }
}
