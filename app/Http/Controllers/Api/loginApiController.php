<?php

namespace App\Http\Controllers\Api;
use App\Models\Blog;
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
        $posts = collect();
        $token = $user->createToken('api-token')->plainTextToken;
        $posts = Blog::where('user_id', $user->id)->latest()->get();
        session(['api_token' => $token]);                 
        if($posts !== NULL){
           return view('logged',[
            'posts'=>$posts,
            'token'=> $token,
            'user'=>$user->name
           ]);
        }else{
            return view('logged');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('api_token');
        Auth::logout();
        return redirect()->route('home')->with('message', 'Logout feito com sucesso!');
    }
}
