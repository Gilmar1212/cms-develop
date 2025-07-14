<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
class IndexController extends Controller
{
    public  function index(){
        $user = Auth::user();
        $tokens = collect();
        $posts = collect();
       if($user){
        $tokens = PersonalAccessToken::where('tokenable_id', $user->id)
        ->select('id', 'name', 'created_at', 'last_used_at', 'token')
        ->get();        
        }                     
        $posts = Blog::where('user_id', $user->id)->latest()->get();
        
           return view('index',[
            'posts'=>$posts,
            'tokens'=> $tokens,
            'user' =>$user
           ]);
       
    }  
   
}
