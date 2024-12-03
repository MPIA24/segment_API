<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */


    public function count(){
        $totalUser = User::count();
        return response()->json([
            'totalUser' => $totalUser,
        ], 200);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        // check crendentials
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // get auth user
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        // Return token and datas of the user
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        //delete the token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }

}
