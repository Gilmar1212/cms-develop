<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class blogController extends Controller
{
    public function blog()
    {
        return view('blog');
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
        // $cadastro->slug = $request->title;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $cadastro->image_url = $path;
        }

        $cadastro->save();

        return redirect()->back()->with('success', 'Postagem criada com sucesso!');
    }
}