<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Authentication
 *
 * APIs to manage user authentication.
 * */
class AuthController extends ApiBaseController
{
    /**
     * Login
     *
     * Provide registered email and password to generate a token.
     *
     * @throws ValidationException
     * @unauthenticated
     */
    public function generateToken(LoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json(['token' => $token], Response::HTTP_OK);
    }

    /**
     * Logout
     *
     * Revoke the token that was used to authenticate the current request.
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    /**
     * Logout from all devices
     *
     * Revoke all tokens that belong to the authenticated user.
     */
    public function logoutEveryWhere(Request $request): Response
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
