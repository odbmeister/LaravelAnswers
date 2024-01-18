<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class ApiController extends Controller
{
    public function github($username)
    {
        $client = new GuzzleClient();
        $response = $client->get("https://api.github.com/users/$username");
        $body = json_decode($response->getBody());

        print "Name: $body->name <br />";
        print "Location: $body->location <br />";
    }
    public function getWeather()
    {
        return view('weather');
    }
    public function postWeather(Request $request)
    {
        $this->validate($request, ['location' => 'required|min:5']);

        // google api to get coords
        $googleClient = new GuzzleClient();
        $response = $googleClient->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $request->location
            ]
        ]);

        $googleBody = json_decode($response->getBody());
        $coords = $googleBody->results[0]->geometry->location;

        print "Lat: $coords->lat <br />";
        print "Lng: $coords->lng <br />";
        //use the coords to get weather from the weather api
    }
}
