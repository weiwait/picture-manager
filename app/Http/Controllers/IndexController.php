<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $images = Storage::allFiles('public/images');
        foreach ($images as $key => $image) {
            $images[$key] = 'storage' . trim($image, 'public');
        }
        return response()->json($images);
}

    public function add(Request $request)
    {
        if ($request->file('picture')->isValid()) {
            return $request->picture->store('public/images');
        }
        return false;
    }

    public function view()
    {
        $images = Storage::allFiles('public/images');
        foreach ($images as $key => $image) {
            $images[$key] = 'storage' . trim($image, 'public');
        }

        return view('index.view', compact('images'));
    }

    public function delete(Request $request)
    {
        Storage::delete('public/images/' . $request->file);
        return redirect('view');
    }
}
