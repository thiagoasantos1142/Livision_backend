<?php

namespace App\Core\UseCases;

use App\Core\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function execute(array $credentials): array
    {
        $userEntity = $this->userRepository->findByEmail($credentials['email']);

        if (!$userEntity || !Hash::check($credentials['password'], $userEntity->password)) {
            throw new \Exception('Credenciais inválidas');
        }

        // Obtenha o modelo Eloquent para criar o token
        $userModel = $this->userRepository->getEloquentModel($userEntity);
        $token = $userModel->createToken('auth_token')->plainTextToken;

          return [
            'user' => [
                'id' => $userEntity->id,
                'name' => $userEntity->name,
                'email' => $userEntity->email
            ],
            'token' => $token
        ];
    }
}
