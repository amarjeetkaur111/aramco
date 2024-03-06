<?php

use App\Models\Apis\User;
use App\Models\Apis\notification;
use App\Models\Apis\notification_detail;
use App\Models\Apis\channels_posts_likes;

function sendNotification($title,$body,$fcmTokens=[],$manual=null,$receiver_id=[],$sender_id=null,$is_feedback_on=null,$module=null)
{



    try {

            $url = 'https://fcm.googleapis.com/fcm/send';
            // $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
            $serverKey = env('FIREBASE_SERVER_KEY');
            $payloadData = [
                'screen' => 'services',
                'date' => 'Something you want to use'
            ];



            $data = [
                "registration_ids" => $fcmTokens,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                    'icon' => 'http://65.2.1.185/aramco/public/assets/img/logo.jpg', // URL to the icon image
                    'sound' => 'https://samplelib.com/lib/preview/mp3/sample-12s.mp3', // URL to the notification sound
                ],
                "data" => $payloadData
            ];
            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);

            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            // Close connection
            curl_close($ch);
            $result = json_decode($result,true);

            if($result['success'] == 1 && $result['failure'] == 0)
            {
                // $notification  = new notification;
                // $notification->sender_id = $sender_id;
                // $notification->title = $title;
                // $notification->body = $body;
                // $notification->manual = $manual == true ? 1 : 0;
                // if($is_feedback_on){
                //     $notification->is_feedback_on = true;
                // }
                // $notification->save();
                // $notification_id =  $notification->id;

                // foreach($receiver_id as $receiver)
                // {
                //     $detail = new notification_detail;
                //     $detail->notification_id = $notification_id;
                //     $detail->receiver_id = $receiver;
                //     if($module){
                //         $detail->module =  $module;
                //     }

                //     $detail->save();
                // }
                 return true;
            }
            else
                return $result['result'];
        // FCM response

    } catch (\Exception $e) {
        report($e);
        return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
    }

}

 function  saveNotificationsDB($title,$body,$fcmTokens=[],$manual=null,$receiver_id=[],$sender_id=null,$is_feedback_on=null,$module=null){


    $notification  = new notification;
    $notification->sender_id = $sender_id;
    $notification->title = $title;
    $notification->body = $body;
    $notification->manual = $manual == true ? 1 : 0;
    if($is_feedback_on){
        $notification->is_feedback_on = true;
    }
    $notification->save();
    $notification_id =  $notification->id;

    foreach($receiver_id as $receiver)
    {
        $detail = new notification_detail;
        $detail->notification_id = $notification_id;
        $detail->receiver_id = $receiver;
        if($module){
            $detail->module =  $module;
        }

        $detail->save();
    }
    return true;
}


function getAdminIds($column){




    $authorizedRoles = ['Super Admin', 'Admin'];

$data = User::select($column)->whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->get()->toArray();

                $data = array_column($data, $column);


                return $data;


}


function getNonAdminIds($role,$column){




    $authorizedRoles = [$role];

$data = User::select($column)->whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->get()->toArray();

                $data = array_column($data, $column);


                return $data;


}



 function getTimePassed($fromdate,$todate){
    $to = \Carbon\Carbon::parse($todate);
    $from = \Carbon\Carbon::parse($fromdate);
        $years = $to->diffInYears($from);
        $months = $to->diffInMonths($from);
        $weeks = $to->diffInWeeks($from);
        $days = $to->diffInDays($from);
        $hours = $to->diffInHours($from);
        $minutes = $to->diffInMinutes($from);
        $seconds = $to->diffInSeconds($from);

       return array(
        'years'  => $years,
        'months'  => $months,
        'weeks'  => $weeks,
        'days'  => $days,
        'hours'  => $hours,
        'minutes'  => $minutes,
        'seconds'  => $seconds
       );
    }

    function checkPostLike($post_id)
    {
        $user_id = auth()->user()->id;
        $liked = channels_posts_likes::where('users_id',$user_id)->where('channels_posts_id',$post_id)->get();
        if(count($liked) > 0)
            return true;
        else
            return false;
    }
    function getRoleName(int $user_id = null)
    {
        // dd($user_id);
        if (!empty($user_id))
        {
            return implode(', ' , User::find($user_id)->getRoleNames()->toArray());
        }
    }
