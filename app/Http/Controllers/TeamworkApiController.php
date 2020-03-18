<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TeamworkApiController
{
    public $token;
    public $url;

    public function __construct()
    {
        $this->url = config('services.teamwork.url');
        $this->token = config('services.teamwork.token');
    }

    /**
     * @return mixed
     */
    public function activity()
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/latestActivity.json');

        $activity = collect($response->json()['activity'])->map(function ($item, $key) {
            //return $item;
            return [
                'id' => $item['id'],
                'type' => $item['type'],
                'activity' => $item['activitytype'],
                'description' => $item['description'],
                'project' => $item['project-name'],
                'user' => $item['fromusername'],
                'user_img' => $item['from-user-avatar-url'],
            ];
        });

        return $activity;
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function boardColumn($id)
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/boards/columns/' . $id . '/cards.json/');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function milestone($id)
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/milestone/' . $id . '.json');

        return $response->json();
    }

    /**
     * @return mixed
     */
    public function milestones()
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/milestones.json');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function project($id)
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/projects/' . $id . '.json');

        return $response->json();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function projectBoard($id)
    {
        // Projekte - 353552
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/projects/' . $id . '/boards/columns.json');

        return $response->json();
    }

    /**
     * @return mixed
     */
    public function projects()
    {
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/projects.json');

        return $response->json();
    }
}
