<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return Auth::user();
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))) {
            return response([
                'message' => 'Invalid credentials'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24);

        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success logout'
        ])->withCookie($cookie);
    }
}
