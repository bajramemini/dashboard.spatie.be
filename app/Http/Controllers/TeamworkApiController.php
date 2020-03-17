<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TeamworkApiController
{
    public function activity()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/latestActivity.json');

        return $response->json();

    }
}
