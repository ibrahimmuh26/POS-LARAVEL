<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
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
        $username = users::where('username', $request->username)->first();
        if ($username) {
            return response()->json([
                'success' => false,
                'message' => 'Username already exists'
            ]);
        }

        $user = users::create([
            'username' => $request->username,
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
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            // $user = users::where('email', $loginUserData['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;
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
