<?php namespace Fytinnovations\ClashFreaks\Classes;

/**
 * This is a adapter class for making calls to the clash of clans API
 */
class ClashAPIAdapter
{
    /**
     * Stores the API Key required to make requests.
     *
     * @var [type]
     */
    private static $api_key;

    /**
     * Stores the base URL for making requests
     */
    private static $base_url="https://api.clashofclans.com/v1/";

    public function __construct(){
        $this->api_key=config('clash_of_clans.api_key');
    }

    public static function getTopPlayers(){
        $header=[
            'endpoint'=>"players/%23LGC9RLPC",
        ];
        self::request($header);
    }

    private static function request($header)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::$base_url.$header['endpoint'],
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer ".self::$api_key,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: api.clashofclans.com",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
