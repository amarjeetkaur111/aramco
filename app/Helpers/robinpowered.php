<?php

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

    function CreateRobinEvent($record_id,$type){

            if($type=="event_request"){
            $event = event_request::where('id', $record_id)->get();
            $space_id=$event[0]->space_name;
            $title=$event[0]->event_name;
            $start_date_time=$event[0]->start_date;
            $end_date_time=$event[0]->end_date;
            $description=$event[0]->justification." -" .$event[0]->additional_info;
            }

            if($type=="incubator_request"){
            $event = incubator_request::where('id', $record_id)->get();
            $space_id=$event[0]->space_name;
            $title=$event[0]->usecase_name;
            $start_date_time=$event[0]->start_date;
            $end_date_time=$event[0]->end_date;
            $description=$event[0]->justification." -" .$event[0]->additional_info;
            }

            if($type=="technology_workshop_request"){
            $event = technology_workshop_request::where('id', $record_id)->get();
            $space_id=$event[0]->space_name;
            $title=$event[0]->workshop_name;
            $start_date_time=$event[0]->start_date;
            $end_date_time=$event[0]->end_date;
            $description=$event[0]->justification." -" .$event[0]->additional_info;
            }


            $data = array(
            'title' => $title,
            "start" => [
                "date_time" => date('Y-m-d\TH:i:s',strtotime($start_date_time))."+0300",
                "time_zone" => config('app.timezone')
            ],
            "end" => [
                "date_time" =>date('Y-m-d\TH:i:s',strtotime($end_date_time))."+0300",
                "time_zone" => config('app.timezone')
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

            // dd();
                    $response = [
                    'success' => false,
                    'message' => $err,
                    ];
                    $code = 404;
                    return response()->json($response, $code);
            }
            else
            {
                //  echo $response;
                $res=json_decode($response);
                if($res->meta->status_code==201){
                    $success=true;
                    $event_robin_id_arr = array('robin_event_id' => $res->data->id);

                    if($type=="event_request"){
                    event_request::where('id', $record_id)->update($event_robin_id_arr);
                    }
                    if($type=="incubator_request"){
                    incubator_request::where('id', $record_id)->update($event_robin_id_arr);
                    }
                    if($type=="technology_workshop_request"){
                    technology_workshop_request::where('id', $record_id)->update($event_robin_id_arr);
                    }

                }else{

                    $success=false;
                }

            $response = [
            'success' => $success,
            'message' => $res->meta,
            'data' => $res->data,
            ];
            return response()->json($response, 200);
        }
    }

    function DeleteRobinEvent($record_id,$type)
    {
        if($type=="event_request"){

        $event = event_request::where('id', $record_id)->get();
        $robin_event_id=$event[0]->robin_event_id;
        }
        if($type=="incubator_request"){
        $event = incubator_request::where('id', $record_id)->get();
        $robin_event_id=$event[0]->robin_event_id;
        }
        if($type=="technology_workshop_request"){

        $event = technology_workshop_request::where('id', $record_id)->get();
        $robin_event_id=$event[0]->robin_event_id;
        }

        if($robin_event_id)
        {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.robinpowered.com/v1.0/events/".$robin_event_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "DELETE",
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
                $response = [
                'success' => false,
                'message' => $err,
                ];
                $code = 404;
                return response()->json($response, $code);
            } else {
                $res=json_decode($response);
                if($res->meta->status_code==200){
                    $success=true;
                    $event_robin_id_arr = array('robin_event_id' => null);

                    if($type=="event_request"){
                    event_request::where('id', $record_id)->update($event_robin_id_arr);
                    }

                    if($type=="incubator_request"){
                    incubator_request::where('id', $record_id)->update($event_robin_id_arr);
                    }
                    if($type=="technology_workshop_request"){
                    technology_workshop_request::where('id', $record_id)->update($event_robin_id_arr);
                    }
                }else{
                    $success=false;
                }
                $response = [
                'success' => $success,
                'message' => $res->meta,
                'data' => $res->data,
                ];
                return response()->json($response, 200);
            }
        }
        else{
            $response = [
                'success' => true,
                'message' => 'No Record to Delete from Robins',
                ];
                return response()->json($response, 200);
        }

    }
