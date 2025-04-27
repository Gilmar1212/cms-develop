<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showJsonController extends Controller
{
    public function genInfos()
    {
        // Pega todos os blogs e retorna como resposta JSON
        $data = DB::table('blogs')->get();
        return response()->json($data);
    }

    public function show($slug)
    {
        // Buscar o post pelo slug
        $post = DB::table('blogs')->where('slug', $slug)->first(); // Ajuste aqui

        // Verifica se o post foi encontrado
        if ($post) {
            return response()->json($post, 200); // Retorna os dados do post em formato JSON
        } else {
            return response()->json(['message' => 'Post não encontrado'], 404);
        }
    }
}

