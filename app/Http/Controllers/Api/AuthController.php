<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //function for register user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash::make($request->password),
        ]);

        return response()->json([
            'success' => 'success',
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }

    //function loginGoole
    public function loginGoogle(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);

        $id_token = $request->id_token;
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($id_token);
        //check if the payload is valid
        if ($payload) {
            $user = User::where('email', $payload['email'])->first();
            //check if user is !$user
            if ($user) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'success' => 'success',
                    'message' => 'User logged in successfully',
                    'user' => [
                        'user' => $user,
                        'token' => $token
                    ],
                ], 201);
            } else {
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'google_id' => $payload['sub'],
                ]);
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'success' => 'success',
                    'message' => 'User logged in successfully',
                    'user' => [
                        'user' => $user,
                        'token' => $token
                    ],
                ], 201);
            }
        } else {
            return response()->json([
                'success' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    //function for login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'success' => 'success',
            'message' => 'User logged in successfully',
            'user' => [
                'user' => $user,
                'token' => $token
            ],
        ], 200);
    }

    //function for logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => 'success',
            'message' => 'User logged out successfully',
        ], 200);
    }
}
