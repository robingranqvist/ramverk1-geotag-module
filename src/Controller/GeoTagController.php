<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Robin\Models\GeoTag;
use Robin\Models\GeoTagIp;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * The controller for the Geo Tag Weather Service
 */
class GeoTagController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Index
     */
    public function indexAction()
    {
        $title = "Geo Tag";

        $page = $this->di->get("page");
        $page->add("geotag/index");

        return $page->render([
            "title" => $title,
        ]);
    }

    /*
    * POST
    */
    public function validateActionPost()
    {   
        $title = "Geo Tag - Resultat";
        $request = $this->di->get("request");

        // Getting the inputs
        $latitude = $request->getPost("lat-input");
        $longitude = $request->getPost("long-input");
        $ip_main = $request->getPost("ip-check");
        
        // A variable to check errors
        $checked = false;
        $geoTag = new GeoTag();

        if ($ip_main != "") {
            $ip_test = new GeoTagIp();
            $ip_test->setupGeoIp($ip_main);

            if ($ip_test->getRegion() == "") {

                $error = "Var vänlig ange en riktig IPV4.";

            } else {

                // $geoTag = new GeoTag();
                $geoTag->setLatLongFromIp($ip_main);

                $lat = $geoTag->getLat();
                $lon = $geoTag->getLon();

                // Validates coordinates
                $covalidator = $this->di->get("covalidator");
                $coordinates = $covalidator->validateCo($lat, $lon);

                // If coordinates are valid
                if ($coordinates) {

                    $geoTag->getWeather($lat, $lon);
                    $geoTag->getCurrentWeather($lat, $lon);
                    $checked = true;

                }

            }

        } else if ($latitude != "" && $longitude != "") {

            // Validates coordinates
            $covalidator = $this->di->get("covalidator");
            $coordinates = $covalidator->validateCo($latitude, $longitude);

            if ($coordinates) {

                // Gets lat & lon
                // $geoTag = new GeoTag();
                $geoTag->getWeather($latitude, $longitude);
                $geoTag->getCurrentWeather($latitude, $longitude);
                $checked = true;

            } else {

                $error = "Var vänlig ange riktiga koordinater.";

            }

        } else {

            $error = "Var vänlig ange riktiga uppgifter.";

        }


        // Sending results
        if ($checked) {

            $data = [
                "current_temp" => $geoTag->getCurrentTemp(),
                "current_feels_like" => $geoTag->getCurrentFeelsLike(),
                "current_weather_main" => $geoTag->getCurrentWeatherMain(),
                "current_wind_speed" => $geoTag->getCurrentWindSpeed(),
                "prev_temp" => $geoTag->getTemperature(),
                "prev_feels_like" => $geoTag->getFeelsLike(),
                "prev_weather_main" => $geoTag->getWeatherMain(),
                "prev_wind_speed" => $geoTag->getWindSpeed(),
                "lat" => $geoTag->getLat(),
                "lon" => $geoTag->getLon(),
                "error" => $error ?? ""
            ];

        } else {

            // Needed for the array
            $break_array = ["", "", "", "", "", ""];

            $data = [
                "current_temp" => "",
                "current_feels_like" => "",
                "current_weather_main" => "",
                "current_wind_speed" => "",
                "prev_temp" => $break_array,
                "prev_feels_like" => $break_array,
                "prev_weather_main" => $break_array,
                "prev_wind_speed" => $break_array,
                "lat" => "",
                "lon" => "",
                "error" => $error ?? ""
            ];

        }

        // Write to view
        $page = $this->di->get("page");
        $page->add("geotag/validate", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function jsonActionGet()
    {
        $request = $this->di->get("request");

        // Getting the inputs
        $latitude = $request->getGet("lat");
        $longitude = $request->getGet("lon");
        $ip_main = $request->getGet("ip");
        
        // A variable to check errors
        $checked = false;
        $geoTag = new GeoTag();

        if ($ip_main != "") {
            $ip_test = new GeoTagIp();
            $ip_test->setupGeoIp($ip_main);

            if ($ip_test->getRegion() == "") {

                $error = "Var vänlig ange en riktig IPV4.";

            } else {

                // $geoTag = new GeoTag();
                $geoTag->setLatLongFromIp($ip_main);

                $lat = $geoTag->getLat();
                $lon = $geoTag->getLon();

                // Validates coordinates
                $covalidator = $this->di->get("covalidator");
                $coordinates = $covalidator->validateCo($lat, $lon);

                // If coordinates are valid
                if ($coordinates) {

                    $geoTag->getWeather($lat, $lon);
                    $geoTag->getCurrentWeather($lat, $lon);
                    $checked = true;

                }

            }

        } else if ($latitude != "" && $longitude != "") {

            // Validates coordinates
            $covalidator = $this->di->get("covalidator");
            $coordinates = $covalidator->validateCo($latitude, $longitude);

            if ($coordinates) {

                // Gets lat & lon
                // $geoTag = new GeoTag();
                $geoTag->getWeather($latitude, $longitude);
                $geoTag->getCurrentWeather($latitude, $longitude);
                $checked = true;

            } else {

                $error = "Var vänlig ange riktiga koordinater.";

            }

        } else {

            $error = "Var vänlig ange riktiga uppgifter.";

        }


        // Sending results
        if ($checked) {

            $json = [
                "current_temp" => $geoTag->getCurrentTemp(),
                "current_feels_like" => $geoTag->getCurrentFeelsLike(),
                "current_weather_main" => $geoTag->getCurrentWeatherMain(),
                "current_wind_speed" => $geoTag->getCurrentWindSpeed(),
                "prev_temp" => $geoTag->getTemperature(),
                "prev_feels_like" => $geoTag->getFeelsLike(),
                "prev_weather_main" => $geoTag->getWeatherMain(),
                "prev_wind_speed" => $geoTag->getWindSpeed(),
                "lat" => $geoTag->getLat(),
                "lon" => $geoTag->getLon(),
                "error" => $error ?? ""
            ];

        } else {

            // Needed for the array
            $break_array = ["", "", "", "", "", ""];

            $json = [
                "current_temp" => "",
                "current_feels_like" => "",
                "current_weather_main" => "",
                "current_wind_speed" => "",
                "prev_temp" => $break_array,
                "prev_feels_like" => $break_array,
                "prev_weather_main" => $break_array,
                "prev_wind_speed" => $break_array,
                "prev_lat" => "",
                "prev_lon" => "",
                "error" => $error ?? ""
            ];

        }

        return [$json];
    }

    public function routeGet()
    {
        return "test";
    }
}
