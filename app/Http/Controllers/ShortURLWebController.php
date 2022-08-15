<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortURLWebController extends Controller
{
    public function shortURL(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $validate->messages(),
            ]);
        }

        $short_url = base_convert(rand(1000000, 99999999), 10, 36);
        $checkShortURL = ShortURL::where('short_url', $short_url)->first();

        if ($checkShortURL == null) {
            $url = ShortURL::create([
                'user_id' => auth()->user() ? auth()->user()->id : 0,
                'url' => $request->url,
                'short_url' => $short_url,
            ]);

            return redirect()->back()->with([
                'status' => true,
                'message' => $short_url,
            ]);
        }
    }

    public function redirect($short_url)
    {
        $getURL = ShortURL::where('short_url', $short_url)->first();

        if ($getURL !== null) {
            $getURL->increment('visited');
            return redirect($getURL->url);
        }

        return response()->json([
            'status' => false,
            'message' => 'Short URL tersebut tidak ada'
        ]);
    }
}
