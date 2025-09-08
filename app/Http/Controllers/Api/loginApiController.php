<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends Controller
{
    public function returnViewLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['message' => 'Credenciais inválidas']);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
        session(['api_token' => $token]);
        return view('logged',['token' => $token,
            'user'  => $user->name]);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('api_token');
        Auth::logout();
        return redirect()->route('/')->with('message', 'Logout feito com sucesso!');
    }
}
