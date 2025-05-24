<?php

// app/Core/Contracts/UserRepositoryInterface.php
namespace App\Core\Contracts;

use App\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity;
    public function findByEmail(string $email): ?UserEntity;
    public function getEloquentModel(UserEntity $userEntity);
    

}