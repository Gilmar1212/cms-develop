<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginApiController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email','password');
        if(!Auth::attempt($credentials)){
                return response()->json(['message'=>'Credenciais inválidas']);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logout feito com sucesso']);
    }
}
