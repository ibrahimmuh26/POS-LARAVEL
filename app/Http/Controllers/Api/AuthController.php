<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'have an error',
                'data' => $validator->errors()
            ]);
        }
        $email = users::where('email', $request->email)->first();
        if ($email) {
            return response()->json([
                'success' => false,
                'message' => 'Username already exists'
            ]);
        }

        $user = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // $user = users::where('email', $loginUserData['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            cache::put('auth_token', $token, 60 * 24 * 30);
            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully',
                'data' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Failed to login'
            ]);
        }
    }


    // auth()->user()->token()->revoke();
    // Auth::user()->token()->delete();

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully'

        ]);
    }
}
