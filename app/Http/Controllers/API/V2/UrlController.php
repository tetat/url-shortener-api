<?php

namespace App\Http\Controllers\API\V2;

use App\Models\Url;
use App\Http\Resources\UrlResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUrlRequest;
use App\Models\User;
use App\Services\UrlService;

class UrlController extends Controller
{
    public function __construct(private UrlService $urlService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $urls = $this->urlService->getUserUrls($user);

        return response()->json(UrlResource::collection($urls));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $data = $this->urlService->storeUrl(
            $request->user(),
            $request->validated()
        );

        if ((int)($data['statusCode']/100) !== 5) {
            $data['url'] = 'http://127.0.0.1:8000/api/v2/urls/' . $data['url'];
        }

        return response()->json($data, $data['statusCode']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        $urlKey = 'url_' . $url->url;
        if (!Cache::has($urlKey)) {
            $url->increment('views');
            Cache::put($urlKey, true, 300); // prevent view duplication for 5 minutes
        }
        
        return redirect($url->originalUrl);
    }
}
