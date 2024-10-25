<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\Helper;
use App\Models\Url;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Resources\UrlResource;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $urls = Url::where('user_id', $request->user()->id)->get();

        if ($urls->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No urls found'
            ]);
        }

        return response()->json(UrlResource::collection($urls));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $validated = $request->validated();
        
        $url = Url::where('originalUrl', $validated['originalUrl'])->first();
        if ($url) {
            return response()->json([
                'url' => 'http://127.0.0.1:8000/api/v1/' . $url->url,
            ], 200);
        }

        $validated['url'] = Helper::randomString(6);
        $validated['user_id'] = $request->user()->id;

        if (!Url::create($validated)) {
            return response([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 500);
        }

        return response()->json([
            'url' => 'http://127.0.0.1:8000/api/v1/' . $validated['url'],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        return redirect($url->originalUrl);
    }
}
