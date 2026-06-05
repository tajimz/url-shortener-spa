<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function index(Request $request)
    {
        return $request->user();
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required', // to identify where the user logged in

        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.'
            ], 401);
        }
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'message' => 'Logged In successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'device_name' => 'required|string'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        $token = $user->createToken($validated['device_name'])->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully. Please verify your email',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    function resendEmailVerification(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => "You are verified already, Click I've verified button to proceed"
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification link sent!'
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'old_password' => ['required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8'],
        ]);
        if (!empty($validated['name'])) {
            $user->name = $validated['name'];
        }

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    public function socialLogin(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string',
            'id_token' => 'required',
            'device_name' => 'required'
        ]);

        $provider = $validated['provider'];

        if ($provider !== 'google') {
            return response()->json([
                'message' => 'Unsupported provider'
            ], 400);
        }

        $client = new Google_Client([
            'client_id' => config('services.google.client_id')
        ]);

        $payload = $client->verifyIdToken($validated['id_token']);

        if (!$payload) {
            return response()->json([
                'message' => 'Invalid Google token'
            ], 401);
        }

        $email = $payload['email'];
        $name = $payload['name'] ?? 'User';
        $googleId = $payload['sub'] ?? null;

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
            ]
        );

        $user->google_id = $googleId;
        $user->email_verified_at = now();
        $user->save();

        $token = $user->createToken($validated['device_name'])->plainTextToken;

        return response()->json([
            'message' => 'Google login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
}
