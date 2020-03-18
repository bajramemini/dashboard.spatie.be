<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TeamworkApiController
{
    /**
     * @return mixed
     */
    public function activity()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/latestActivity.json');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function boardColumn($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/boards/columns/' . $id . '/cards.json/');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function milestone($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/milestone/' . $id . '.json');

        return $response->json();
    }

    /**
     * @return mixed
     */
    public function milestones()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/milestones.json');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function project($id)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/projects/' . $id . '.json');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function projectBoard($id)
    {

        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/projects/' . $id . '/boards/columns.json');

        return $response->json();
    }

    /**
     * @return mixed
     */
    public function projects()
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/projects.json');

        return $response->json();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function projekteBoard($slug)
    {
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/boards/columns/109510/cards.json/');

        return $response->json();

    }

    /**
     * @return mixed
     */
    public function projekteWichtig()
    {
        // Wichtig 109510
        // Aufgaben 109508
        // Erledigt 109559
        // Demnächst 111944
        //
        $url   = config('services.teamwork.url');
        $token = config('services.teamwork.token');

        $response = Http::withBasicAuth($token, 'X')->get($url . '/boards/columns/109510/cards.json/');

        return $response->json();

    }
}
