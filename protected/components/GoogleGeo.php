<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeoLocation
 *
 * @author zqi2
 */
class GoogleGeo
{
    // Reference    https://developers.google.com/maps/documentation/geocoding/index
    // Daily Limit 2500
    // Geocoding
    //      https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY
    // Reverse Geocoding (Address Lookup)
    //      https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=API_KEY

    const GOOGLE_HTTP_GEO = 'https://maps.googleapis.com/maps/api/geocode/json?address=[ADDRESS]&key=[API_KEY]';
    const GOOGLE_HTTP_REV_GEO = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=[LAT_LNG]&key=[API_KEY]';

    private $api_key = null;

    public $status;
    public $lat;
    public $lng;
    public $formatted_address;
    public $postal;
    public $country;

    public function setApiKey($key){
        $this->api_key = $key;
    }

    public function geocode($country, $postal)
    {
        $address = $country . $this->postal;
        $website = str_replace('[ADDRESS]', $address, GoogleGeo::GOOGLE_HTTP_GEO);
        $website = str_replace('[API_KEY]', $address, $this->api_key);

        //TODO
    }
}

