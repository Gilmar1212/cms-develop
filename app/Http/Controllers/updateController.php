<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class updateController extends Controller
{
    public function returnUpdate()
    {
        return view('alterar');
    }
    public function update(Request $request)
    {
        // Validação dos dados enviados
        $validatedData = $request->validate([
            'id' => 'required|exists:blogs,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Encontre o blog post pelo ID (assumindo que o ID é enviado no request)
        $blog = Blog::find($request->id);        
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog post not found.');
        }

        // Atualize os campos do blog post
        $blog->title = $validatedData['title'];
        $blog->short_description = $validatedData['short_description'];
        $blog->content = $validatedData['content'];

        
        if ($request->hasFile('image')) {
            // Exclua a imagem antiga, se existir
            if ($blog->image_url && Storage::exists('public/' . $blog->image_url)) {
                Storage::delete('public/' . $blog->image_url);
            }
        
            // Salve a nova imagem
            $imagePath = $request->file('image')->store('blog', 'public');
            $blog->image_url = $imagePath;
        }

        // Salve as alterações
        $blog->save();

        // Redirecione com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Post atualizado com sucesso.');
    }
}
