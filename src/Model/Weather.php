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

        $this->forecast();
        $this->history();
    }

    private function forecast()
    {
        $apiKey = file_get_contents(ANAX_INSTALL_PATH . "/weatherapi.txt");

        $res = MCurl::get([
            "https://api.openweathermap.org/data/2.5/onecall?lat=56.16156&lon=15.58661&units=metric&exclude=hourly,minutely,current&appid={$apiKey}"
        ]);

        foreach($res[0]->daily as $day) {
            array_push($this->weather['forecast'], [
                'date' => date("yy-m-d", $day->dt),
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

    private function history()
    {
        $apiKey = file_get_contents(ANAX_INSTALL_PATH . "/weatherapi.txt");

        $res = MCurl::get([
            "http://api.openweathermap.org/data/2.5/onecall/timemachine?lat=56.16156&lon=15.58661&dt=".strtotime('-1 day')."&units=metric&appid={$apiKey}",
            "http://api.openweathermap.org/data/2.5/onecall/timemachine?lat=56.16156&lon=15.58661&dt=".strtotime('-2 day')."&units=metric&appid={$apiKey}",
        ]);

        foreach($res as $day) {
            array_push($this->weather['history'], [
                'date' => date("yy-m-d", $day->current->dt),
                'temp' => $day->current->temp,
                'weather' => $day->current->weather[0]->main,
                'weather-description' => $day->current->weather[0]->description,
                'weather-icon' => $day->current->weather[0]->icon,
                'day' => date("D", $day->current->dt)
            ]);
        }
        
    }

    public function getForecast()
    {
        return $this->weather['forecast'];
    }

    public function getHistory()
    {
        return $this->weather['history'];
    }

}
