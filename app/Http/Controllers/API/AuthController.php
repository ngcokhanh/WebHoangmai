<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        try {
            request()->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', request('email'))->first();

            if (!$user || !Hash::check(request('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect'],
                ]);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully',
                'data' => $user,
                'token' => $token
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function logout()
    {
        try {
            request()->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Logout successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed'
            ], 422);
        }
    }

    public function register()
    {
        try {
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            $user = User::create($data);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Register successfully',
                'data' => $user,
                'token' => $token
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Register failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
}
