<?php

namespace Robin\Models;

/**
 * Model for checking geographical position of 
 * IP address through the IPStack API
 */
class GeoTagIp {

    // Global variables
    private $ip;
    private $type;
    private $country;
    private $region;
    private $city;
    private $latitude;
    private $longitude;

    public function setupGeoIp($ip) {

        // Key & URL
        $key = "6a628cedd2e6ba989f43140b4d6cfd0c";
        $url = "http://api.ipstack.com/$ip?access_key=$key";

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
        $location = json_decode($data, true);

        // Set variables
        $this->ip = $location['ip'];
        $this->type = $location['type'];
        $this->country = $location['country_name'];
        $this->region = $location['region_name'];
        $this->city = $location['city'];
        $this->latitude = $location['latitude'];
        $this->longitude = $location['longitude'];

        return $location;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getType() {
        return $this->type;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getCity() {
        return $this->city;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

}