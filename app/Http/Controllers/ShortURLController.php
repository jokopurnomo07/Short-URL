<?php

namespace App\Http\Controllers;

use App\Models\ShortURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortURLController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['redirect', 'shortURL']]);
    }

    public function shortURL(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->messages(), 422);
        }

        $short_url = base_convert(rand(1000000, 99999999), 10, 36);
        $checkShortURL = ShortURL::where('short_url', $short_url)->first();

        if ($checkShortURL == null) {
            $url = ShortURL::create([
                'user_id' => auth()->user() ? auth()->user()->id : 0,
                'url' => $request->url,
                'short_url' => $short_url,
            ]);

            return response()->json([
                'status' => 'OK',
                'message' => env('APP_URL') . 'api/to/' . $short_url,
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

    public function listURL()
    {
        $data = ShortURL::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'status' => 'OK',
            'data' => $data
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = ShortURL::find($id);
        if ($data) {
            $data->update([
                'short_url' => $request->url,
            ]);

            return response()->json([
                'status' => 'OK',
                'message' => env('APP_URL') . 'api/to/' . $request->url,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Short URL dengan ID tersebut tidak ada'
        ]);
    }

    public function delete($id)
    {
        $data = ShortURL::find($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'OK',
                'message' => "URL has been deleted!",
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Short URL dengan ID tersebut tidak ada'
        ]);
    }

    public function statistik($id){
        $data = ShortURL::find($id);
        if($data){
            return response()->json([
                'id' => $data->id,
                'datetime' => $data->created_at,
                'total' => $data->count('visited'),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Short URL dengan ID tersebut tidak ada'
        ]);
    }
}
