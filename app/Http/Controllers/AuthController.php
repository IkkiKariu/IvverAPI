<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request)
    {
        $payload = $request->json()->all();

        $validator = Validator::make($payload, [
            'login' => ['required', 'exists:users,login'],
            'password' => ['required'] 
        ]);
        
        if ($validator->fails())
        {
            return response()->json(status: 401);
        }

        $token = $this->authService->auth($validator->validated());

        return $token ? response()->json(data: ['token' => $token], status: 200) : response()->json(status: 401);
    }

    public function logout(Request $request)
    {
        $this->authService->forgetToken($request->bearerToken());

        return response()->json(status: 200);
    }
}
