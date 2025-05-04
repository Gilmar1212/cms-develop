<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;

class deletePostController extends Controller
{
    public function destroy($id)
    {
        $post = Blog::find($id);
        if ($post) {
            // Verifica se há uma imagem associada ao post
            if ($post->image_url && Storage::disk('public')->exists($post->image_url)) {
                Storage::disk('public')->delete($post->image_url);
            }
            // Remove o post do banco de dados
            $post->delete();

            return redirect()->route('home')->with('success', 'Post e imagem deletados com sucesso.');
        } else {
            return redirect()->route('home')->with('error', 'Post não encontrado.');
        }
    }
}