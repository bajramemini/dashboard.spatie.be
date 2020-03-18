<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TeamworkProjekteController
{
    public $token;
    public $url;

    public function __construct()
    {
        $this->url = config('services.teamwork.url');
        $this->token = config('services.teamwork.token');
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function columns()
    {
        // Projekte - 353552
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/projects/353552/boards/columns.json');

        return $response->json();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function board($slug)
    {
        $lookup = [
            'wichtig' => 109510,
            'aufgaben' => 109508,
            'erledigt' => 109559,
            'in_arbeit' => 109509,
            'demnaechst' => 111944,
        ];

        abort_if(!array_key_exists($slug, $lookup), 422);
        
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/boards/columns/' . 
        $lookup[$slug].'/cards.json/');
        //return $response->json();

        $users = collect($response->json()['people']);

        $activity = collect($response->json()['cards'])->map(function ($item, $key) use($users) {
            //return $item;
            return [
                'id' => $item['id'],
                'due_date' => $item['dueDate'],
                'name' => $item['name'],
                'status' => $item['status'],
                'priority' => $item['priority'],
                'completed' => $item['completed'],
                'description' => $item['description'],
                'progress' => $item['progress'],
                'tags' => $item['tags'],
                'users' => collect($item['assignedPeople'])->map(function ($item, $key) use($users) {
                    return $users[$item];
                }),
            ];
        });

        return $activity;
    }

    
}
