<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class showJsonController extends Controller
{
    public function genInfos()
    {
        $data = DB::table('blogs')->get();
        return response()->json($data);
        
    }
}
