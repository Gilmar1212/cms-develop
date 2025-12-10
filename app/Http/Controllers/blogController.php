<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function create()
    {
        return view('blog');
    }
     public function edit()
    {
        return view('alterar');
    }
    public function store(Request $request)
    {
        $cadastro = new Blog;

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:200'
        ]);

        $cadastro->title = $request->title;
        $cadastro->content = $request->content;
        $cadastro->slug = Str::slug($request->title);
        $cadastro->short_description = $request->short_description;
        $cadastro->user_id = $request->user_id;
        // $cadastro->slug = $request->title;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $cadastro->image_url = $path;
        }

        $cadastro->save();

        return redirect()->back()->with('success', 'Postagem criada com sucesso!');
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