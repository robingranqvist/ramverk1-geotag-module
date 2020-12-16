<?php

namespace Robin\Models;

/**
 * Model for getting the weather data for 
 * the Geo Tag Service.
 */
class GeoTag {

    // Global variables
    // private $w_main;
    // private $w_desc;
    // private $w_temp;

    private $latitude;
    private $longitude;

    private $temperature = [];
    private $feels_like = [];
    private $weather_main = [];
    private $wind_speed = [];

    private $c_temperature;
    private $c_feels_like;
    private $c_weather_main;
    private $c_wind_speed;
    
    /**
     * Extra method to get current weather. 
     * Only needs one curl.
     */
    public function getCurrentWeather($lat, $lon) {

        // Require API-keys
        require ANAX_INSTALL_PATH . "/config/keys.php";

        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$key_weather&units=metric";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        // Get res
        $res = json_decode($data, true);

        $this->c_temperature = $res["main"]["temp"];
        $this->c_feels_like = $res["main"]["feels_like"];
        $this->c_weather_main = $res["weather"][0]["main"];
        $this->c_wind_speed = $res["wind"]["speed"];
        
    }

    public function getCurrentTemp()
    {
        return $this->c_temperature;
    }

    public function getCurrentFeelsLike()
    {
        return $this->c_feels_like;
    }

    public function getCurrentWeatherMain()
    {
        return $this->c_weather_main;
    }

    public function getCurrentWindSpeed()
    {
        return $this->c_wind_speed;
    }

    // Gets weather based on latitude & longitude
    public function getWeather($lat, $lon) {

        $this->latitude = $lat;
        $this->longitude = $lon;
        
        $time = strtotime("now");

        $times = [
            0 => strtotime("-1 day", $time),
            1 => strtotime("-2 day", $time),
            2 => strtotime("-3 day", $time),
            3 => strtotime("-4 day", $time),
            4 => strtotime("-5 day", $time),
            5 => strtotime("-6 day", $time),
        ];

        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Require API-keys
        require ANAX_INSTALL_PATH . "/config/keys.php";

        $mh = curl_multi_init();
        $chAll = [];

        // Loops & gets res
        $i = 0;
        while( $i < 6 ) {
            $time = $times[$i];
            $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=$lat&lon=$lon&dt=$time&appid=$key_weather&units=metric";
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
            $i++;
        };

        // Execute all
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        // Close all
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        $res = [];

        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $res[] = json_decode($data, true);
        }

        $x = 0;
        while( $x < 5 ) {
            array_push($this->temperature, $res[$x]["current"]["temp"]);
            array_push($this->feels_like, $res[$x]["current"]["feels_like"]);
            array_push($this->weather_main, $res[$x]["current"]["weather"][0]["main"]);
            array_push($this->wind_speed, $res[$x]["current"]["wind_speed"]);
            $x++;
        };

        return $res;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getFeelsLike()
    {
        return $this->feels_like;
    }

    public function getWeatherMain()
    {
        return $this->weather_main;
    }

    public function getWindSpeed()
    {
        return $this->wind_speed;
    }

    // Gets the lat & lon from IP
    public function setLatLongFromIp($ip) {

        // Require API-keys
        require ANAX_INSTALL_PATH . "/config/keys.php";

        $url = "http://api.ipstack.com/$ip?access_key=$key_ip";

        // Init curl
        $ch = curl_init();

        // Setup
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Execute
        $data = curl_exec($ch);

        // Close
        curl_close($ch);

        // Result
        $latlon = json_decode($data, true);
        
        // number_format($numberAsFloat, 2); -> if needed

        // Set variables
        $this->latitude = $latlon['latitude'];
        $this->longitude = $latlon['longitude'];
    }
    
    // For IP
    public function getLat()
    {
        return $this->latitude;
    }
    
    public function getLon()
    {
        return $this->longitude;
    }

}