<?php

namespace App\Http\Controllers\API\V2;

use App\Models\Url;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Resources\UrlResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUrlRequest;

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
                'error' => 1,
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
                'url' => 'http://127.0.0.1:8000/api/v2/' . $url->url,
            ], 200);
        }

        $validated['url'] = Helper::randomString(6);
        $validated['user_id'] = $request->user()->id;

        if (!Url::create($validated)) {
            return response([
                'error' => 1,
                'message' => 'Something went wrong'
            ], 500);
        }

        return response()->json([
            'url' => 'http://127.0.0.1:8000/api/v2/' . $validated['url'],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        // prevent duplication view for 5 minutes
        $urlKey = 'url_' . $url->url;
        if (!Cache::has($urlKey)) {
            $url->increment('views');
            Cache::put($urlKey, true, 300);
        }
        
        return redirect($url->originalUrl);
    }
}
