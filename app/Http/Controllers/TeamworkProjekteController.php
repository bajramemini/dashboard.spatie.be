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
            'in_arbeit' => 109508,
            'demnaechst' => 111944,
        ];
        $response = Http::withBasicAuth($this->token, 'X')->get($this->url . '/boards/columns/109510/cards.json/');

        return $response->json();
    }

    
}
