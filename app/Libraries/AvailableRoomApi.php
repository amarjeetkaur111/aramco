<?php

namespace App\Libraries;

class AvailableRoomApi
{
    private $base_url;
    private $location_id;
    private $include;
    private $access_token;

    public function __construct(){
        $this->base_url = "https://api.robinpowered.com/v1.0/locations";
        $this->location_id = "767783";
        $this->include = "state";
        $this->access_token = env('ROBIN_ACCESS_TOKEN');
    }

    public function getList()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->makeURL(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: access-token $this->access_token",
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }

    public function makeURL()
    {
        return $this->base_url . '/' . $this->location_id . '/' . 'spaces?page=1&per_page=1000&include=' . $this->include;
    }



}
