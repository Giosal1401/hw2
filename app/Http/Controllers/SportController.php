<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class SportController extends BaseController
{

    public function index(){
        return view('sportPage');
    }

    public function searchSportByName($query){
        $url = "https://sports.api.decathlon.com/sports/search/";
        return Http::get($url.$query, [
            "coordinates" => "-73.5826985,45.5119864"
        ]);
    }

    public function searchSportById($query){
        $url = "https://sports.api.decathlon.com/sports/";
        return Http::get($url.$query);
    }

    public function jsonGroups(){
        $url = 'https://sports.api.decathlon.com/groups';
    
        return Http::get($url);
    }

    public function searchGroupById($query){
        $url = 'https://sports.api.decathlon.com/groups/';
    
        return Http::get($url.$query);
    }

}

?>