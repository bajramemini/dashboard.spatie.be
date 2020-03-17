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

    public function projects()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/projects.json');

        return $response->json();
    }

    public function project($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/projects/' . $id . '.json');

        return $response->json();
    }

    public function milestones()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/milestones.json');

        return $response->json();
    }
    public function milestone($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/milestone/' . $id . '.json');

        return $response->json();
    }

    public function boardColumn($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/boards/columns/' . $id . '/cards.json/');

        return $response->json();
    }

}
