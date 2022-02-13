<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register
     * @RegisterRequest => contain validations
     */
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('MyToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);

    }


    /**
     * Login
     * @LoginRequest contains validations
     */

    public function login(LoginRequest $request)
    {

        //check email and password
        $credentials = $request->only('email','password');

        if(!Auth::attempt($credentials))
        {
            return response(['message' => 'Invalid login credential'],401);
        }

        $user = Auth::user();

        $token = $user->createToken('MyToken')->plainTextToken;

        return response()->json([
            'message' => 'logggin succesfull',
            'data' => $user,
            'token' => $token
        ],200);
    }


    /**
     * Logout function
     */

    public function logout()
    {
        auth()->user()->tokens()->delete();
        
        return response(['message' => 'Loggedout successfully'],200);
    }
}
