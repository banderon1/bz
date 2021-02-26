<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function weather(Request $request)
    {
        if (!$request->has('zip')) {
            return view('welcome');
        }


        $zip = (int)$request->input('zip');
        $url = self::getWeatherUrl($zip, 'us');

        try {
            $response = (new Client)->get($url)->getBody()->getContents();
        } catch (GuzzleException $e) {
            //if there are errors with the request, handle them here
            $response = [];
        }

        $data = json_decode($response, true);
        return view('welcome', ['data' => $data]);
    }

    private static function getWeatherUrl($zip, $country): string
    {
        $endpoint = 'https://api.openweathermap.org/data/2.5/weather';
        $appid = config('weather.appid');
        return $endpoint . http_build_query(['zip' => $zip . ',' . $country, 'appid' => $appid]);
    }
}
