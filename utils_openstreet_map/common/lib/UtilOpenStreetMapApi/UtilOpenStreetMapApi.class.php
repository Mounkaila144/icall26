<?php

class UtilOpenStreetMapApi {
    protected $parameters = [], $latitude, $longitude, $city, $postcode, $country_code, $error = '';
    const API_ENDPOINT = "https://nominatim.openstreetmap.org/search";
    const BASE_TILE_URL = "https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png";

    public function getCoordinatesFromAddress($address) {
        $this->parameters['address'] = $address;
        $response = $this->call();
        if (!$response || empty($response[0]['lat']) || empty($response[0]['lon'])) {
            $this->error = $response ? 'Invalid coordinates format.' : 'API error.';
            return false;
        }
        $this->latitude = $response[0]['lat'];
        $this->longitude = $response[0]['lon'];
        foreach (['city', 'postcode', 'country_code'] as $field) {
            $this->$field = isset($response[0]['address'][$field]) ? $response[0]['address'][$field] : '';
        }
        return true;
    }

    public function __call($name, $arguments)
    {
        if (preg_match('/^(get|set)([A-Z]\w*)$/', $name, $m) && property_exists($this, $p = lcfirst($m[2])))
            return $m[1] === 'get' ? $this->$p : $this->$p = $arguments[0];
        throw new Exception("Method $name does not exist");
    }
    public function getCountryCode() {return $this->country_code;}
    private function call() {
        if (empty($this->parameters['address'])) {
            $this->error = 'No address provided.';
            return false;
        }
        $url = self::API_ENDPOINT . "?format=json&addressdetails=1&q=" . urlencode($this->parameters['address']);
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'icall26/1.0 (icall26@gmail.com)',
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);
        $content = curl_exec($curl);
        if ($content === false) {
            $this->error = 'cURL error: ' . curl_errno($curl) . ": " . curl_error($curl);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        return json_decode($content, true);
    }
}

