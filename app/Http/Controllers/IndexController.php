<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Trophy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::query()->select(['id', 'image'])->orderBy('sort', 'desc')->get()->toArray();
        return response()->json($banners);
    }

    public function informationList()
    {
        $informationList = Trophy::query()->select(['id', 'image', 'title', 'created_at'])->get()->toArray();
        return response()->json($informationList);
    }

    public function add(Request $request)
    {
        if ($request->file('picture')->isValid()) {
            $image = $request->picture->store('public/images');
            $image = 'storage' . trim($image, 'public');
            $banner = new Banner;
            $banner->image = $image;
            $banner->content = '';
            $banner->sort = Banner::query()->count('*');
            if ($banner->save()) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function view()
    {
        $images = Banner::query()->orderBy('sort', 'desc')->get()->toArray();

        return view('index.view', compact('images'));
    }

    public function delete(Request $request)
    {
        Storage::delete('public/images/' . $request->file);
        Banner::destroy($request->id);

        $images = Banner::query()->select(['id'])->orderBy('sort', 'asc')->get();

        $images->each(function ($image, $key) {
            $image->sort = $key;
            $image->save();
        });

        return redirect('view');
    }

    public function sortUp(Request $request)
    {
        $pre = Banner::query()->where('sort', '=', $request->sort + 1)->first();
        if ($pre) {
            $pre->sort = 99999;
            if ($pre->save()) {
                if (Banner::query()->where('sort', '=',  $request->sort)->increment('sort')) {
                    $pre = Banner::query()->where('sort', '=', 99999)->first();
                    $pre->sort = $request->sort;
                    $pre->save();
                }
            }
        }

        return redirect('view');
    }

    public function sortDown(Request $request)
    {
        $next = Banner::query()->where('sort', '=',  $request->sort - 1)->first();
        if ($next) {
            $next->sort = 88888;
            if ($next->save()) {
                if (Banner::query()->where('sort', '=', $request->sort)->decrement('sort')) {
                    $next = Banner::query()->where('sort', '=',  88888)->first();
                    $next->sort = $request->sort;
                    $next->save();
                }
            }
        }

        return redirect('view');
    }

    public function getContent(Request $request)
    {
        $content = Banner::query()->select('content')->find($request->id);

        return response()->json(['data' => $content]);
    }

    public function pushContent(Request $request)
    {
        $banner = Banner::query()->find($request->id);
        $banner->content = $request->data;
        if ($banner->save()) {
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0]);
    }

}
