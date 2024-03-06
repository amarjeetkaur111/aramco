<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\schedule_visit;
use App\Models\Apis\event_request;
use App\Models\Apis\incubator_request;
use App\Models\Apis\computing_resources_request;
use App\Models\Apis\technology_workshop_request;
use App\Models\Apis\idea_request;
use App\Models\Apis\required_resource_list;
use App\Models\Apis\technology_list;
use App\Models\Apis\current_implementation_level;
use App\Models\Apis\general_reservation;
use App\Models\Apis\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RobinpoweredController extends Controller
{
    //

    public function CreateEvent(Request $request){

        $space_id=$request->space_name;
        $event_title=$request->event_title;
        $start_date_time=$request->start_date_time;
        $end_date_time=$request->end_date_time;
        $description=$request->description;
        $recurrence=$request->recurrence;

        $data = array(
            'title' => $event_title,
            "start" => [
                "date_time" => $start_date_time,
                "time_zone" => env('TIMEZONE')
             ] ,
             "end" => [
                "date_time" => $end_date_time,
                "time_zone" => env('TIMEZONE')
             ] ,
            'description' => $description,

        );

        $json = json_encode($data);

            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.robinpowered.com/v1.0/spaces/".$space_id."/events",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => [
                "Authorization: Access-Token qdZ7lejesIsfBRV5GTVbLuiBde23sQerIoNEGV83eCxw0AwcU9ek6j39qKILdr6xLMdrbN6YKjEmreKtfeP7UwBWzIA7GYt2wELP6vbXlHkEo3A0C75PlJc7b2h1tFLL",
                "accept: application/json",
                "content-type: application/json"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            // echo "cURL Error #:" . $err;


            $response = [
                'success' => false,
                'message' => $err,
            ];
            $code = 404;
            return response()->json($response, $code);
            } else {
            // echo $response;

            $response = [
                'success' => true,
                'data' => $data,
                'message' => "Event has been Created successfully",
            ];
            return response()->json($response, 200);
            }
    }




}
