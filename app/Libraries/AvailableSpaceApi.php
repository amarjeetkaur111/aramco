<?php

namespace App\Libraries;

class AvailableSpaceApi
{
    private $base_url;
    private $space_id;
    private $access_token;
    private $state_date;
    private $end_date;

    public function __construct($space_id, $state_date, $end_date) {
        $this->base_url = "https://api.robinpowered.com/v1.0/spaces";
        $this->space_id = $space_id;
        // take form waseem
//        $this->state_date =  date('Y-m-d\TH:i:s',strtotime($state_date))."+0300";
//        $this->end_date = date('Y-m-d\TH:i:s',strtotime($end_date))."+0300";

        $this->state_date = date('Y-m-d\TH:i', strtotime($state_date)).':00Z';
        $this->end_date = date('Y-m-d\TH:i', strtotime($end_date)).':00Z';
        $this->access_token = env('ROBIN_ACCESS_TOKEN');
    }

    public function getSpace()
    {
        $curl = curl_init();
        //dd($this->makeURL());

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
        return $this->base_url . '/' . $this->space_id . '/events?after=' . $this->state_date . '&before='. $this->end_date .'&page=1&per_page=1000';
    }
}
