<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ApiResponser;

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $tokenResult = $user->createToken(Str::random(10))->plainTextToken;
        return $this->successResponse([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ],200);
    }
}
