<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
class LoginController extends Controller
{
    public function returnViewLogin()
    {
        return view('logged');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['message' => 'Credenciais inválidas']);
        }
        $user = Auth::user();
        $posts = Blog::where('user_id' , $user->id)->latest()->get();

        return view('logged',['user'=>$user->name,'posts'=>$posts]);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('api_token');
        Auth::logout();
        return redirect()->route('/')->with('message', 'Logout feito com sucesso!');
    }
}