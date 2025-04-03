<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * User Registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|max:12',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * User Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return response()->json([
            'message' => 'Login Successful',
            'user' => auth()->user(),
            'token' => $token,
        ], 200);
    }

    /**
     * Logout the user
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'User successfully logged out'
            ], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }

    /**
     * Refresh Token
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'token' => $newToken
            ], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token refresh failed'], 500);
        }
    }

    /**
     * Get the authenticated user details (Protected)
     */
    public function profile()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json([
                'message' => 'User profile retrieved successfully',
                'user' => $user,
            ], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid or expired token'], 401);
        }
    }

    /**
     * Protected Dashboard Route
     */
    public function dashboard()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json([
                'message' => 'Welcome to the Admin Dashboard',
                'user' => $user,
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is Invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token is Expired'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not found'], 401);
        }
    }
}
