<?php

namespace Fytinnovations\ClashFreaks\Classes;

use Cache;
use October\Rain\Exception\ApplicationException;

class ClashOfClans
{
    private $api_key;

    const INTERNATION_LOCATION_ID = 32000006;

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
        $data = $this->cachedRequest($header);
        return $data;
    }

    public function getTopPlayers($locationID = self::INTERNATION_LOCATION_ID, $after=null,$before=null,$limit=10)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/.$locationID./rankings/players",
            "key" => __FUNCTION__ . $locationID . $limit . $after
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }

    public function getTopClans($locationID = self::INTERNATION_LOCATION_ID, $after=null,$before=null,$limit=10)
    {
        $offsetQuery=$after?'&after?$after':"";
        $header = [
            "endpoint" => $this->base_url . "locations/" . $locationID .
                "/rankings/clans?limit=$limit".$offsetQuery,
            "key" => __FUNCTION__ . $locationID . $limit . $after
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }

    /**
     * Caches the request for an hour 
     *
     * @param [type] $header
     * @return void
     */
    private function cachedRequest($header)
    {
        $response = Cache::remember($header["key"], now()->addMinutes(60), function () use ($header) {
            return $this->request($header);
        });
        return $response;
    }

    private function request($header)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $header["endpoint"],
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
            return json_decode($response);
        }
    }
}
