<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\calendar_events;
use App\Models\Apis\calendar_events_registrations;
use App\Models\Apis\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    //


    public function CreateCalendarEvent(Request $request){


        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {
                // $eventrequests = event_request::get();



                $file_path = "";

                if ($request->has('calendar_image')) {

                    if (env('STORAGE') == "local") {
                        $file = $request->calendar_image;
                        $filename = str_replace(' ','_',strtolower($request->channel_id)) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->calendar_image->getClientOriginalExtension();
                        $fileup = $file->storeAs('calendarevents', $filename, ['disk' => 'my_files']);
                        $file_path = env('ASSET_URL') . '/uploads/calendarevents/' . $filename;

                    }

                    if (env('STORAGE') == "s3") {
                        $filee = $request->calendar_image;
                        $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                        $path = Storage::disk('s3')->putFileAs('', $request->calendar_image, "calendarevents/" . $filename, 'public');
                        $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                    }
                }


                $calendar_events = new calendar_events;
                $calendar_events->title = $request->title;
                $calendar_events->description =$request->description;
                $calendar_events->start_date = $request->start_date;
                $calendar_events->end_date = $request->end_date;
                $calendar_events->calendar_image= $file_path;
                $calendar_events->created_by = $userid;
                $calendar_events->save();


                $response = [
                    'success' => true,
                    'message' => "Event has been created successfully",
                ];
                return response()->json($response, 200);
            } else {
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        } else {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }






    }









    public function UpdateCalendarEvent(Request $request){

        $google_id = $request->google_id;


        $event_id = $request->event_id;
        $adminddata = User::where('google_id', $google_id)->get();

        $calendar_eventsdata=calendar_events::Select('title')->where('id', $event_id)->get()->toArray();
        //  dd($calendar_eventsdata[0]['title']);
        $eventregdata=calendar_events_registrations::Select('users_id')->where('calendar_events_id', $event_id)->get()->toArray();

        if (count($adminddata) > 0) {
            $userid = $adminddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {






                $file_path = "";

                if ($request->has('calendar_image')) {

                    if (env('STORAGE') == "local") {
                        $file = $request->calendar_image;
                        $filename = str_replace(' ','_',strtolower($request->channel_id)) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->calendar_image->getClientOriginalExtension();
                        $fileup = $file->storeAs('calendarevents', $filename, ['disk' => 'my_files']);
                        $file_path = env('ASSET_URL') . '/uploads/calendarevents/' . $filename;

                    }

                    if (env('STORAGE') == "s3") {
                        $filee = $request->calendar_image;
                        $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                        $path = Storage::disk('s3')->putFileAs('', $request->calendar_image, "calendarevents/" . $filename, 'public');
                        $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                    }

                            $event_request_img_arr = array(

                            'calendar_image' => $file_path,

                            );
                            calendar_events::where('id', $event_id)->update($event_request_img_arr);
                }



                                $event_request_arr = array(
                                'title' => $request->title,
                                'description' =>$request->description,
                                'start_date' => $request->start_date,
                                'end_date' => $request->end_date,

                            );
                            calendar_events::where('id', $event_id)->update($event_request_arr);





                            $manual = 0;  // because the push notification is being sent by system

                            // dd($receiver_id);
                            $receivers = User::whereIN('id',$eventregdata)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                            $receivers_token = array_column($receivers, 'fcm_token');
                            $fcm_token = $receivers_token;


                            $sender_id = $adminddata[0]->id;

                            $title = "Calendar Event information Update" ;
                            $body = "Admin has updated the information of the calendar Event ".$calendar_eventsdata[0]['title'];
                            if(count($fcm_token) > 0)
                            {
                                sendNotification($title,$body,$fcm_token,$manual,$eventregdata,$sender_id);

                            }

                            saveNotificationsDB($title,$body,$fcm_token,$manual,$eventregdata,$sender_id);


                            $response = [
                                'success' => true,
                                'data' => "Calendar Event has been updated successfully",
                            ];
                            return response()->json($response, 200);


            } else {
                            $error = 'This user must have rights of Super admin to perform this operation';
                            $response = [
                                'success' => false,
                                'message' => $error,
                            ];
                            $code = 404;
                            return response()->json($response, $code);
            }
        } else {
                        $error = 'Unauthorize user request or this id does not exist';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
        }




    }




    public function GetCalendarEvents(Request $request){



        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $calendar_events =calendar_events::select('calendar_events.id','calendar_events.title','calendar_events.description','calendar_events.calendar_image','calendar_events.start_date','calendar_events.end_date','calendar_events.is_deleted')
		// ->whereDate('start_date', '>=', $startDate)
		->whereDate('end_date', '>=', $startDate)
        ->whereDate('end_date', '<=', $endDate)
		->get()->toArray();


        if (count($calendar_events) > 0) {




                    //checking if user google id has been sent to get all events with the flag if he registered with it or not along with its status
                        if($request->google_id){


                            $generaluserdata = User::where('google_id', $request->google_id)->get();

                            $finaleventarr=array();

                            foreach($calendar_events as $event){


                                $calendar_events_reg = calendar_events_registrations::select('status')->where('users_id',$generaluserdata[0]->id)->where('calendar_events_id', $event['id'])->get()->toArray();


                                if(count($calendar_events_reg)>0){



                                    // dd( $calendar_events_reg);

                                    $finaleventarr[]= array(
                                    "id" => $event['id'],
                                    "title" => $event['title'],
                                    "description" => $event['description'],
                                    "calendar_image" => $event['calendar_image'],
                                    "start_date" => $event['start_date'],
                                    "end_date" => $event['end_date'],
                                    "is_registered" => true,
                                    "status" => $calendar_events_reg[0]['status'],
                                    "is_deleted" =>  $event['is_deleted'],
                                     );




                                }else{

                                    $finaleventarr[]= array(
                                        "id" => $event['id'],
                                        "title" => $event['title'],
                                        "description" => $event['description'],
                                        "calendar_image" => $event['calendar_image'],
                                        "start_date" => $event['start_date'],
                                        "end_date" => $event['end_date'],
                                        "is_registered" => false,
                                        "status" =>"",
                                        "is_deleted" =>  $event['is_deleted'],
                                         );
                                }


                            }


                            $calendar_events = $finaleventarr;

                        }


                            $response = [
                                'success' => true,
                                'data' => $calendar_events,
                            ];
                            return response()->json($response, 200);

                    } else {
                        $error = 'No event Found';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
                    }
    }


    public function RegisterCalendarEvent(Request $request){




        $generaluserdata = User::where('google_id', $request->google_id)->get();
        $calendar_events_registrations = new calendar_events_registrations;
        $calendar_events_registrations->users_id = $generaluserdata[0]->id;
        $calendar_events_registrations->calendar_events_id =$request->event_id;
        $calendar_events_registrations->status = "Pending";
        $calendar_events_registrations->save();


        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;


        $sender_id = $generaluserdata[0]->id;

        $title = "Event Registration Request";
        $body = "user has requested to register an Event";
        if(count($fcm_token) > 0)
        {
            sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        }
        saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


        $response = [
            'success' => true,
            'data' => "You have been registered for this event successfully",
        ];
        return response()->json($response, 200);



    }





    public function ChangeCalendarEventRegistrationStatus(Request $request){

        $google_id = $request->google_id;
        $users_google_id = $request->users_google_id;
        $status = $request->status;
        $event_id = $request->event_id;
        $adminddata = User::where('google_id', $google_id)->get();
        $usersdata = User::where('google_id', $users_google_id)->get();

        $eventdata=calendar_events_registrations::where('calendar_events_id', $event_id)->get();

        if (count($adminddata) > 0) {
            $userid = $adminddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {




                            $event_request_arr = array(
                                'status' => $status,
                            );
                            calendar_events_registrations::where('calendar_events_id', $event_id)->where('users_id',$usersdata[0]->id)->update($event_request_arr);


                            $adminfeedback="";


                            if($status=="Rejected"){

                                    if($request->feedback){
                                        $adminfeedback=" Admin Feedback: ".$request->feedback;

                                    }

                            }


                            $manual = 0;  // because the push notification is being sent by system
                            $receiver_id =$usersdata[0]->id;
                            // dd($receiver_id);
                            $receivers = User::where('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                            
                            //Added By Amarjeet
                            $receiver_id = array($receiver_id);
                            //Added By Amarjeet

                            $receivers_token = array_column($receivers, 'fcm_token');
                            $fcm_token = $receivers_token;


                            $sender_id = $adminddata[0]->id;

                            $title = "Event Request has been ". $status ;
                            $body = "Admin has ". $status ." your event request.". $adminfeedback;
                            if(count($fcm_token) > 0)
                            {
                                sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                            }

                            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                            $response = [
                                'success' => true,
                                'data' => "Event Registration status has been changed successfully",
                            ];
                            return response()->json($response, 200);


            } else {
                            $error = 'This user must have rights of Super admin to perform this operation';
                            $response = [
                                'success' => false,
                                'message' => $error,
                            ];
                            $code = 404;
                            return response()->json($response, $code);
            }
        } else {
                        $error = 'Unauthorize user request or this id does not exist';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
        }




    }








    public function DeleteCalendarEvent(Request $request){

        $google_id = $request->google_id;


        $event_id = $request->event_id;
        $adminddata = User::where('google_id', $google_id)->get();

        $calendar_eventsdata=calendar_events::Select('title')->where('id', $event_id)->get()->toArray();
        //  dd($calendar_eventsdata[0]['title']);
        $eventregdata=calendar_events_registrations::Select('users_id')->where('calendar_events_id', $event_id)->get()->toArray();

        if (count($adminddata) > 0) {
            $userid = $adminddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {




                            $event_request_arr = array(
                                'is_deleted' => true,
                            );
                            calendar_events::where('id', $event_id)->update($event_request_arr);





                            $manual = 0;  // because the push notification is being sent by system

                            // dd($receiver_id);
                            $receivers = User::whereIN('id',$eventregdata)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                            $receivers_token = array_column($receivers, 'fcm_token');
                            $fcm_token = $receivers_token;


                            $sender_id = $adminddata[0]->id;

                            $title = "Calendar Event Deleted" ;
                            $body = "Admin has deleted the calendar Event ".$calendar_eventsdata[0]['title'];
                            if(count($fcm_token) > 0)
                            {
                                sendNotification($title,$body,$fcm_token,$manual,$eventregdata,$sender_id);

                            }
                            saveNotificationsDB($title,$body,$fcm_token,$manual,$eventregdata,$sender_id);

                            calendar_events_registrations::where('calendar_events_id', $event_id)->delete();

                            $response = [
                                'success' => true,
                                'data' => "Calendar Event has been deleted successfully",
                            ];
                            return response()->json($response, 200);


            } else {
                            $error = 'This user must have rights of Super admin to perform this operation';
                            $response = [
                                'success' => false,
                                'message' => $error,
                            ];
                            $code = 404;
                            return response()->json($response, $code);
            }
        } else {
                        $error = 'Unauthorize user request or this id does not exist';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
        }




    }







    public function GetAllEventRegisterRequests(Request $request){



        $google_id = $request->google_id;

        $adminddata = User::where('google_id', $google_id)->get();


        if (count($adminddata) > 0) {
                $userid = $adminddata[0]->id;
                $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
                $userroles_ = str_replace(" ", "_", $userroles);
                $rolesarr = explode(",", $userroles_);
                $authorized_roles = array("Super_Admin", "Admin");
                $result = array_intersect($authorized_roles, $rolesarr);
                if (count($result) > 0) {





                    $calendar_registered_events =calendar_events::select('calendar_events.id','calendar_events.title','calendar_events.description','calendar_events.start_date','calendar_events.end_date','calendar_events.created_at as event_created','users.google_id','calendar_events_registrations.status','calendar_events_registrations.created_at')
                                        ->join('calendar_events_registrations', 'calendar_events.id', '=', 'calendar_events_registrations.calendar_events_id')
                                        ->join('users', 'calendar_events_registrations.users_id', '=', 'users.id')->get()->toArray();


                                        $response = [
                                            'success' => true,
                                            'data' => $calendar_registered_events,
                                        ];
                                        return response()->json($response, 200);



                } else {
                    $error = 'This user must have rights of Super admin to perform this operation';
                    $response = [
                        'success' => false,
                        'message' => $error,
                    ];
                    $code = 404;
                    return response()->json($response, $code);
                }
            } else {
                        $error = 'Unauthorize user request or this id does not exist';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
            }



    }


    public function changeCalendarEventRegistrationStatusBulk(Request $request)
    {
        $google_id = $request->google_id;
        $status = $request->status;

        $get_admin = User::where('google_id', $google_id)->first();
        if ($get_admin) {
            if (in_array($get_admin->getRoleNames()->first(), array("Super Admin", "Admin"))) {
                foreach ($request->requested_data as $value) {
                    $data = explode('_', $value);

                    calendar_events_registrations::where('calendar_events_id', $data[0])->where('users_id', $data[1])->update(['status' => $status]);

                    $adminfeedback="";
                    if($status=="Rejected"){
                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;
                        }
                    }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id = $data[0];

                    $receivers = User::where('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    // Added by Amarjeet //
                    $receiver_id = array($receiver_id);
                    // Added by Amarjeet //

                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $get_admin->id;

                    $title = "Event Request has been ". $status ;
                    $body = "Admin has ". $status ." your event request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
                    saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }

                $response = [
                    'success' => true,
                    'data' => "Event Registration status has been changed successfully",
                ];
                return response()->json($response, 200);
            } else {
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];

                return response()->json($response, 404);
            }
        } else {
            $error = 'Un-authorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];

            return response()->json($response, 404);
        }
    }
}
