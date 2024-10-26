<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'url' => 'http://127.0.0.1:8000/api/' . substr($request->path(), 4, 2) . '/urls/' . $this->url,
          'originalUrl' => $this->originalUrl,
          'views' => $this->views
        ];
    }
}
