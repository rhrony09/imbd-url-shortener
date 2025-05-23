<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller {
    public function login(Request $request) {
        $request->validate([
            'email' => 'required',  // can be email/mobile/username
            'password' => 'required|string',
        ]);

        // Detect login method
        if (is_numeric($request->email)) {
            $credentials = ['mobile' => $request->email, 'password' => $request->password];
        } elseif (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password];
        } else {
            $credentials = ['username' => $request->email, 'password' => $request->password];
        }

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials.',
                'errors' => [
                    'email' => ['Invalid credentials.'],
                ],
            ], 401);
        }

        $user = Auth::user();

        $user_data = $user->only(['id', 'name', 'email', 'mobile']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user_data,
                'token' => $user->createToken('Token for ' . $user->name)->plainTextToken,
            ]
        ], 200);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|unique:users,mobile',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $username = explode('@', $request->email)[0];
        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
        if (User::where('username', $username)->exists()) {
            $i = 1;
            while (User::where('username', $username . $i)->exists()) {
                $i++;
            }
            $username .= $i;
        }

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'role_id' => 3,
            'username' => $username,
            'password' => Hash::make($request->password),
        ]);

        $user_data = $user->only(['id', 'name', 'email', 'mobile']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user_data,
                'token' => $user->createToken('Token for ' . $user->name)->plainTextToken,
            ]
        ], 200);
    }

    public function get_magic_token() {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }
        $magic_token = '';

        if ($user->magic_token) {
            $magic_token = $user->magic_token;
        } else {
            $magic_token = bin2hex(random_bytes(16));
            $user->update(['magic_token' => $magic_token]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'magic_token' => $magic_token,
            ]
        ], 200);
    }

    public function logout() {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout successfull.',
        ], 200);
    }
}
