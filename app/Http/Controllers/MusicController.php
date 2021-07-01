<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class MusicController extends BaseController
{

    public function index(){
        return view('musicPage');
    }

    public function searchMusic($query){
        $url = 'https://api.discogs.com/database/search';
        $headers = [
            "Authorization" =>  "Discogs key=".env('DISCOGS_CONSUMER_KEY').", secret=".env('DISCOGS_CONSUMER_SECRET')
        ];
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36';
    
        return Http::withHeaders($headers)->withUserAgent($userAgent)->get($url,[
            'q' => $query,
            'format' => 'single'
        ]);
    }

}

?>