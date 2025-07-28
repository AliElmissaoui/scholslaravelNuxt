<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function login(Request $request){
        $feilds = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|'
        ]);

        if (!Auth::attempt($feilds)) {
            return response()->json(['errors' => [
                'user' => ['invalid credentials']
            ]], 401);
        }

        $request->session()->regenerate();

        return response()->json(['message' => 'Logged in successfully', 'user' => Auth::user()]);
    }

    public function register(Request $request){
        $feilds = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create($feilds);

      return response()->json([
            'user' => $user,
        ], 200);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

         return response()->json(['message' => 'Logged out']);
    }
}
