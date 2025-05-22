<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->query('city', 'Nairobi');

        $apiKey = env('OPENWEATHER_API_KEY');

        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
        
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'city' => $data['name'],
                'temperature' => $data['main']['temp'],
                'description' => $data['weather'][0]['description'],
                'humidity' => $data['main']['humidity'],
                'wind_speed' => $data['wind']['speed'],
                'icon' => $data['weather'][0]['icon'],
            ]);
        } else {
            return response()->json(['error' => 'City not found or API error'], 404);
        }
    }

    public function getForecast(Request $request)
{
    $city = $request->query('city', 'Nairobi');
    $unit = $request->query('unit', 'metric');
    $apikey = env('OPENWEATHER_API_KEY');

    $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units={$unit}&appid={$apikey}";

    $response = Http::get($url);

    if ($response->successful()) {
        $data = $response->json();

        $forecast = [];

        // Pick one forecast per day from the list (which has 3-hour interval data)
        $usedDays = [];

        foreach ($data['list'] as $entry) {
            $date = substr($entry['dt_txt'], 0, 10); // format: YYYY-MM-DD

            if (!in_array($date, $usedDays)) {
                $forecast[] = [
                    'date' => $date,
                    'temp_min' => $entry['main']['temp_min'],
                    'temp_max' => $entry['main']['temp_max'],
                    'icon' => $entry['weather'][0]['icon'],
                    'description' => $entry['weather'][0]['description'],
                ];
                $usedDays[] = $date;
            }

            if (count($forecast) >= 3) break;
        }

        return response()->json($forecast);
    } else {
        return response()->json(['error' => 'Unable to fetch forecast'], 500);
    }
}

}
