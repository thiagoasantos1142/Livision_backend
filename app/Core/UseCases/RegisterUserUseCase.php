<?php 


// app/Core/UseCases/RegisterUserUseCase.php
namespace App\Core\UseCases;

use App\Core\Contracts\UserRepositoryInterface;
use App\Domain\Entities\UserEntity;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(array $data): UserEntity
    {
        $userEntity = new UserEntity(
            null, // ID será gerado pelo banco
            $data['name'],
            $data['email'],
            bcrypt($data['password'])
        );

        return $this->userRepository->create($userEntity);
    }
}