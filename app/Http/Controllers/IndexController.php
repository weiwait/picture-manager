<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return response()->json(['src' => 'http://img1.imgtn.bdimg.com/it/u=7089644,2848352963&fm=27&gp=0.jpg']);
    }

    public function add(Request $request)
    {
        $request->picture->store('public');
    }

    public function view()
    {
        

        return view('index.view');
    }
}
