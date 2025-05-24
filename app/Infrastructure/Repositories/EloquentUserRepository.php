<?php
// app/Infrastructure/Repositories/EloquentUserRepository.php
namespace App\Infrastructure\Repositories;

use App\Core\Contracts\UserRepositoryInterface;
use App\Domain\Entities\UserEntity;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $userEntity): UserEntity
    {
        $user = User::create([
            'name' => $userEntity->name,
            'email' => $userEntity->email,
            'password' => $userEntity->password
        ]);

        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password
        );
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $user = User::where('email', $email)->first();
        
        return $user ? new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password
        ) : null;
    }
    
    public function getEloquentModel(UserEntity $userEntity): User
    {
        return User::findOrFail($userEntity->id);
    }

    
}