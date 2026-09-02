<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
class showJsonController extends Controller
{
    public function genInfos(Request $request)
    {
        $user = $request->user();
        $data = DB::table('blogs')->where('user_id',$user->id)->get();
        return response()->json($data);
    }

    public function show($slug)
    {
        // Buscar o post pelo slug
        $post = DB::table('blogs')->where('slug', $slug)->first();
        
            if ($post) {
                return response()->json($post, 200);
            } else {
                return response()->json(['message' => 'Post não encontrado'], 404);
            }
        
    
    }
}

