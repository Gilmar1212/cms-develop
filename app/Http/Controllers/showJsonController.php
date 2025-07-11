<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blog;

class showJsonController extends Controller
{
    public function genInfos()
    {
        $user = Auth::user();

        $tokens = [];

        $tokens = PersonalAccessToken::where('tokenable_id', $user->id)->select('id', 'name', 'created_at', 'last_used_at', 'token');

        return response()->json(['posts' => DB::table('blogs')->get()]);
    }

    public function show($slug)
    {
        // O usuário já está autenticado via Sanctum
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
    
        // Buscar o post pelo slug
        $post = Blog::where('slug', $slug)->first();
    
        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json(['message' => 'Post não encontrado'], 404);
        }
    }
}