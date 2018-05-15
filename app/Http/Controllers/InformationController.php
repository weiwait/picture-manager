<?php

namespace App\Http\Controllers;

use App\Trophy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function information()
    {
        $information = Trophy::query()->get()->toArray();

        return view('index.information', compact('information'));
    }

    public function add(Request $request)
    {
        if ($request->file('picture')->isValid()) {
            $image = $request->picture->store('public/images');
            $image = 'storage' . trim($image, 'public');
            $banner = new Trophy();
            $banner->image = $image;
            $banner->content = '';
            $banner->title = '';
            if ($banner->save()) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function delete(Request $request)
    {
        Storage::delete('public/images/' . $request->file);
        Trophy::destroy($request->id);

        return redirect('information');
    }

    public function getContent(Request $request)
    {
        $content = Trophy::query()->select('content')->find($request->id);

        return response()->json(['data' => $content]);
    }

    public function pushContent(Request $request)
    {
        $banner = Trophy::query()->find($request->id);
        $banner->content = $request->data;
        if ($banner->save()) {
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0]);
    }

    public function title(Request $request)
    {
        $banner = Trophy::query()->find($request->id);
        $banner->title = $request->data;
        if ($banner->save()) {
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0]);
    }
}
