<?php
namespace Gufo\Model;

class Weather
{
    protected $lat;
    protected $lon;

    protected $weather = [
        'forecast' => [],
        'history' => []
    ];

    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->long = $lon;

        $this->foreCast();
    }

    private function foreCast()
    {
        $apiKey = file_get_contents(ANAX_INSTALL_PATH . "/weatherapi.txt");

        $res = MCurl::get([
            "https://api.openweathermap.org/data/2.5/onecall?lat=56.16156&lon=15.58661&units=metric&exclude=hourly,minutely,current&appid={$apiKey}"
        ]);

        foreach($res[0]->daily as $day) {
            array_push($this->weather['forecast'], [
                'date' => date("m/d", $day->dt),
                'temp' => $day->temp->day,
                'min' => $day->temp->min,
                'max' => $day->temp->max,
                'weather' => $day->weather[0]->main,
                'weather-description' => $day->weather[0]->description,
                'weather-icon' => $day->weather[0]->icon,
                'day' => date("D", $day->dt)
            ]);
        }
    }

    public function getForecast()
    {
        return $this->weather['forecast'];
    }

}
