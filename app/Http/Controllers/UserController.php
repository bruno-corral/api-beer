<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signup(CreateUserRequest $request): JsonResponse
    {        
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);

        $user = $this->user->create($data);

        $response = [
            'error' => false,
            'message' => 'User entered successfully!',
            'token' => $user->createToken('Register_token')->plainTextToken
        ];

        return response()->json($response);
    }

    public function signin(SignInRequest $request): JsonResponse
    {
        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            $userAuth = Auth::user();

            $token = $userAuth->createToken('Login_token')->plainTextToken;

            $user = $this->user->find($userAuth['id']);

            $user->update(['remember_token' => $token]);
            $user->save();

            $this->validateToken($token, $userAuth['id']);

            $response = [
                'error' => false,
                'token' => $token,
                'user' => [
                    'id' => $userAuth->id,
                    'name' => $userAuth->name,
                    'email' => $request['email'],
                    'password' => $request['password'],
                ] 
            ];

            return response()->json($response);
        }

        return response()->json([
            'error' => true,
            'message' => 'Invalid E-mail and/or Password!'
        ]);
    }

    public function validateToken($token, $id) 
    {
        $user = $this->user->find($id);

        if ($token === $user['remember_token']) {
            $response = [
                'error' => false,
                'user' => $user
            ];

            return response()->json($response);
        }
    }
}
