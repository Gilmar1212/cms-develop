<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class blogController extends Controller
{
   public function blog()
    {
        return view('blog');
    }
    public function store(Request $request){        
          
        $cadastro = new Blog;
        $cadastro->title = $request->title;     
        $cadastro->content = $request->content;     
        
        $cadastro->save();
        
        return redirect("/");
    }
}
