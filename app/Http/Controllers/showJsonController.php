<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
class showJsonController extends Controller
{
    public function genInfos($token)
    {
        // Pega todos os blogs e retorna como resposta JSON
        $tokenRecord = PersonalAccessToken::where('token', $token)->first();
        $tokenValue = optional($tokenRecord)->token;
        if(!$tokenValue){
            return response()->json(['message' => 'Token inválido'], 403);
        }
        if (!$tokenRecord == $token) {
            return response()->json(['message' => 'Você não tem permissão para acessar'], 403);
        }else{            
            $data = DB::table('blogs')->get();
            return response()->json($data);
        }
    }

    public function show($slug, $token)
    {
        // Verifica se o token realmente existe no banco
        $tokenRecord = PersonalAccessToken::where('token', $token)->first();
        $tokenValue = optional($tokenRecord)->token;
        if(!$tokenValue){
            return response()->json(['message' => 'Token inválido'], 403);
        }
        if (!$tokenRecord == $token) {
            return response()->json(['message' => 'Você não tem permissão para acessar'], 403);
        }else{
            // Buscar o post pelo slug
            $post = DB::table('blogs')->where('slug', $slug)->first();
        
            if ($post) {
                return response()->json($post, 200);
            } else {
                return response()->json(['message' => 'Post não encontrado'], 404);
            }

        }
    
    }
}

