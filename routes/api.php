<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

// Public Login Route
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Creates the token for the user
    $token = $user->createToken('myapptoken')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token
    ], 201);
});

// Protected Route (Requires Token)
Route::middleware('auth:sanctum')->get('/check-auth', function (Request $request) {
    return response()->json([
        'message' => 'Authentication Successful!',
        'user' => $request->user()
    ]);
});