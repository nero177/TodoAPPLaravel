<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\DTO\UserDTO;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    public function register(UserCreateRequest $request) : JsonResponse
    {
        $userDTO = new UserDTO($request->name, $request->email, $request->password);
        $this->userService->create($userDTO);

        $credentials = request()->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function login(Request $request) : JsonResponse
    {
        $credentials = request()->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken(string $token) : JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ]);
    }
}
