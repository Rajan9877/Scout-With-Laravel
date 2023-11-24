<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function fetch(){
        $data = User::all();
        return response()->json($data);
    }
    public function index(Request $request){
        $search = $request->input('search');
        $result = User::search($search)->get();  
        return response()->json($result);
    }

}
