<?php

namespace Fytinnovations\ClashFreaks\Classes;

use Cache;
use October\Rain\Exception\ApplicationException;
class ClashOfClans
{
    private $api_key;

    public $base_url = "https://api.clashofclans.com/v1/";

    public function __construct()
    {
        $this->api_key = config('services.clash_of_clans.api_key');
    }

    public function getLocations()
    {
        $header = [
            "endpoint" => $this->base_url . "locations",
            "key" => __FUNCTION__
        ];
        $data = $this->request($header);
        return $data;
    }

    public function getTopPlayers($locationID,$limit,$offset)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/32000113/rankings/players",
            "key" => __FUNCTION__
        ];
        $data = $this->request($header);
        return $data;
    }

    public function request($header)
    {
        //Fetches or stores in the cache for later usage for 1 hour
        $response = Cache::remember($header["key"], 3600, function () use ($header) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL =>$header["endpoint"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer $this->api_key"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                throw new ApplicationException("Eror making request to the server. Try again later");
            } else {
                return $response;
            }
        });
        return $response;
    }
}
