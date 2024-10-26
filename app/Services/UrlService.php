<?php

namespace App\Services;

use App\Models\Url;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Auth\Access\AuthorizationException;

class UrlService
{
    public function getUserUrls(User $user)
    {
        if (!$user->can('index')) {
            throw new AuthorizationException();
        }

        return $user->urls()->get();
    }

    public function storeUrl(User $user, array $url)
    {
        // dd(Session());
        $existedUrl = Url::where('originalUrl', $url['originalUrl'])->first();

        if ($existedUrl) {
            return [
                'status' => 'exist',
                'statusCode' => 400,
                'message' => 'This url already exist in our record',
                'url' => $existedUrl->url,
            ];
        }

        $url['url'] = Helper::randomString(6);

        if (!$user->urls()->create($url)) {
            return [
                'status' => 'error',
                'statusCode' => 500,
                'message' => 'Something went wrong',
            ];
        }

        return [
            'status' => 'success',
            'statusCode' => 201,
            'message' => 'Short url created successfully',
            'url' => $url['url'],
        ];
    }
}
