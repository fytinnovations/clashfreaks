<?php

namespace Fytinnovations\ClashFreaks\Classes;

use Cache;
use Illuminate\Support\Facades\Redirect;
use October\Rain\Exception\ApplicationException;

class ClashOfClans
{
    private $api_key;

    const DEFAULT_CLAN_LOCATION_ID = 32000006;

    const PLAYER_DEFAULT_LOCATION_ID = 32000113;

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

    public function getTopPlayers($locationID = self::PLAYER_DEFAULT_LOCATION_ID, $limit = 10)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/$locationID/rankings/players?limit=$limit",
            "key" => __FUNCTION__ . $locationID . $limit
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }
    public function getTopBuilderPlayers($locationID = self::PLAYER_DEFAULT_LOCATION_ID, $limit = 10)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/$locationID/rankings/players-versus?limit=$limit",
            "key" => __FUNCTION__ . $locationID . $limit
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }

    public function getTopClans($locationID = self::DEFAULT_CLAN_LOCATION_ID, $limit = 10)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/" . $locationID .
                "/rankings/clans?limit=$limit",
            "key" => __FUNCTION__ . $locationID . $limit
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }
    public function getTopBuilderClans($locationID = self::DEFAULT_CLAN_LOCATION_ID, $limit = 10)
    {
        $header = [
            "endpoint" => $this->base_url . "locations/" . $locationID .
                "/rankings/clans-versus?limit=$limit",
            "key" => __FUNCTION__ . $locationID . $limit
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }

    public function getPlayerProfile($playerTag)
    {
        $header = [
            "endpoint" => $this->base_url . "players/" . urlencode($playerTag),
            "key" => __FUNCTION__ . $playerTag
        ];
        $data = $this->cachedRequest($header);
        return $data;
    }
    public function getClanProfile($clanTag)
    {
        $header = [
            "endpoint" => $this->base_url . "clans/" . urlencode($clanTag),
            "key" => __FUNCTION__ . $clanTag
        ];
        
        $data = $this->cachedRequest($header);
        return $data;
    }
    public function searchClans($name,$locationID)
    {
        $header = [
            "endpoint" => $this->base_url . "clans?limit=5&name=" .urlencode($name).'&locationId='.$locationID,
            "key" => __FUNCTION__ . $name.$locationID
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
