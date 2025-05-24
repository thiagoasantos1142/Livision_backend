<?php

namespace App\Http\Controllers\Api;

use App\Core\UseCases\LoginUserUseCase;
use App\Core\UseCases\RegisterUserUseCase;
use App\Domain\Entities\UserEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        protected RegisterUserUseCase $registerUseCase,
        protected LoginUserUseCase $loginUseCase
    ) {}

    public function register(Request $request, RegisterUserUseCase $useCase)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $userEntity = $this->registerUseCase->execute($data);

        return response()->json([
            'id' => $userEntity->id,
            'name' => $userEntity->name,
            'email' => $userEntity->email
        ], 201);
    }

    public function login(Request $request, LoginUserUseCase $useCase)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $result = $useCase->execute($credentials);
            
           return response()->json([
                'user' => $result['user'], // Já está no formato array
                'token' => $result['token']
            ]);

            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
