<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\schedule_visit;
use App\Models\Apis\event_request;
use App\Models\Apis\event_request_invitees;
use App\Models\Apis\incubator_request;
use App\Models\Apis\incubator_request_invitees;
use App\Models\Apis\computing_resources_request;
use App\Models\Apis\technology_workshop_request;
use App\Models\Apis\technology_workshop_request_invitees;
use App\Models\Apis\idea_request;
use App\Models\Apis\required_resource_list;
use App\Models\Apis\technology_list;
use App\Models\Apis\current_implementation_level;
use App\Models\Apis\general_reservation;
use App\Models\Apis\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function scheduleVisitRequest(Request $request)
    {
        // dd("hello");
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $schedule = new schedule_visit;
        $schedule->users_id = $usersaveddata[0]->id;
        $schedule->visit_title = $request->visit_title;
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->num_of_visitors = $request->num_of_visitors;
        $schedule->visitor_coordinator_contact = $request->visitor_coordinator_contact;
        $schedule->justification = $request->justification;
        $schedule->additional_info = $request->additional_info;
        $schedule->status_of_request = 'Pending';

        $is_admin=0;
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {
                $is_admin=1;
                $schedule->status_of_request = 'Approved';
            }
        }
        // $schedule->date_of_request = $request->date_of_request;

        $schedule->save();
        $scheduleid = $schedule->id;
        $saveddata = schedule_visit::where('id', $scheduleid)->get();

        if($is_admin==0){
            $manual = 0;  // because the push notification is being sent by system
            $receiver_id =getAdminIds('id');
            $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
            $receivers_token = array_column($receivers, 'fcm_token');
            $fcm_token = $receivers_token;


            $sender_id = $usersaveddata[0]->id;

            $title = "Schedule Visit Request";
            $body = "user has requested Schedule Visit";
            if(count($fcm_token) > 0)
            {
                 sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

          }


        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "schedule visit request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }

    public function hostEventRequest(Request $request)
    {
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $schedule = new event_request;
        $schedule->users_id = $usersaveddata[0]->id;
        $schedule->event_name = $request->event_name;
        $schedule->space_name = $request->space_name;
        $schedule->required_resources = $request->required_resources;
        $schedule->other_required_resource = $request->other_required_resource;
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->num_of_attendees = $request->num_of_attendees;
        $schedule->coordinator_contact = $request->coordinator_contact;
        $schedule->justification = $request->justification;
        $schedule->additional_info = $request->additional_info;
        $schedule->status_of_request = 'Pending';
        $schedule->save();
        $eventrequestid = $schedule->id;

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $event_request_arr = array(
                    'status_of_request' => 'Approved',
                );
                event_request::where('id', $eventrequestid)->update($event_request_arr);
                $resultrobin= CreateRobinEvent($eventrequestid,"event_request");
                // $resultrobin =  json_decode($resultrobin);
                if($resultrobin->getData()->success != false)
                {
                    //add invitees
                    if($request->display_name!=null ){
                        $display_name = $request->display_name;
                        $email = $request->email;
                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new event_request_invitees;
                            $event_request_invitees->event_request_id = $eventrequestid;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();
                        }
                    }
                }else
                {
                    event_request::where('id', $eventrequestid)->delete();
                    $response = [
                        'success' => false,
                        'message' => 'Something went wrong with Robins',
                        'robin_message' => $resultrobin->getData()->message,
                    ];
                    $code = 200;
                    return response()->json($response, $code);
                }
            }
        }

        if($is_admin==0){

                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $usersaveddata[0]->id;

                $title = "Host an Event Request";
                $body = "user has requested to host an Event";
                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
                 saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

    }

        $saveddata = event_request::where('id', $eventrequestid)->get();
        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "Event request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }

    public function reserveIncubatorRequest(Request $request)
    {
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $incubator_request = new incubator_request;
        $incubator_request->users_id = $usersaveddata[0]->id;
        $incubator_request->usecase_name = $request->usecase_name;
        $incubator_request->space_name = $request->space_name;
        $incubator_request->start_date = $request->start_date;
        $incubator_request->end_date = $request->end_date;
        $incubator_request->contact_of_usecase = $request->contact_of_usecase;
        $incubator_request->num_of_employees = $request->num_of_employees;
        $incubator_request->justification = $request->justification;
        $incubator_request->additional_info = $request->additional_info;
        $incubator_request->status_of_request = 'Pending';
        $incubator_request->save();
        $incubator_requestid = $incubator_request->id;

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $incubator_request_arr = array(
                    'status_of_request' => 'Approved',
                );
                incubator_request::where('id', $incubator_requestid)->update($incubator_request_arr);
                $resultrobin= CreateRobinEvent($incubator_requestid,"incubator_request");
                if($resultrobin->getData()->success != false)
                {
                    //add invitees
                    if($request->display_name!=null ){
                        $display_name = $request->display_name;
                        $email = $request->email;
                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new incubator_request_invitees;
                            $event_request_invitees->incubator_request_id = $incubator_requestid;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();
                        }
                    }

                }else
                {
                    incubator_request::where('id', $incubator_requestid)->delete();
                    $response = [
                        'success' => false,
                        'message' => 'Something went wrong with Robins',
                        'robin_message' => $resultrobin->getData()->message,
                    ];
                    $code = 200;
                    return response()->json($response, $code);
                }
            }
        }

        if($is_admin==0){

            $manual = 0;  // because the push notification is being sent by system
            $receiver_id =getAdminIds('id');
            $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
            $receivers_token = array_column($receivers, 'fcm_token');
            $fcm_token = $receivers_token;


            $sender_id = $usersaveddata[0]->id;

            $title = "Reserve an Incubator Request";
            $body = "user has requested to reserve an Incubator";
            if(count($fcm_token) > 0)
            {
                 sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        }

        $saveddata = incubator_request::where('id', $incubator_requestid)->get();
        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "Incubator request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }
    public function computingResourcesRequest(Request $request)
    {
        // dd("hello");
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $computing_resources_request = new computing_resources_request;
        $computing_resources_request->users_id = $usersaveddata[0]->id;
        $computing_resources_request->usecase_name = $request->usecase_name;
        $computing_resources_request->contact_of_usecase = $request->contact_of_usecase;
        $computing_resources_request->start_date = $request->start_date;
        $computing_resources_request->end_date = $request->end_date;
        $computing_resources_request->num_of_employees = $request->num_of_employees;
        $computing_resources_request->justification = $request->justification;
        $computing_resources_request->additional_info = $request->additional_info;
        $computing_resources_request->status_of_request = 'Pending';


        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $computing_resources_request->status_of_request = 'Approved';
            }
        }
        // $computing_resources_request->date_of_request = $request->date_of_request;
        $computing_resources_request->save();
        $computing_resources_requestid = $computing_resources_request->id;

        if($is_admin==0){

                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $usersaveddata[0]->id;

                $title = "Computing Resource Request";
                $body = "user has requested for Computing Resource";
                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }



        $saveddata = computing_resources_request::where('id', $computing_resources_requestid)->get();
        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "Computing request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }

    public function technologyWorkshopRequest(Request $request)
    {
        // dd($request->all());
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        // dd($usersaveddata);
        $computing_resources_request = new technology_workshop_request;
        $computing_resources_request->users_id = $usersaveddata[0]->id;
        $computing_resources_request->workshop_name = $request->workshop_name;
        $computing_resources_request->space_name = $request->space_name;
        $computing_resources_request->start_date = $request->start_date;
        $computing_resources_request->end_date = $request->end_date;
        $computing_resources_request->point_of_contact = $request->point_of_contact;
        $computing_resources_request->num_of_people = $request->num_of_people;
        $computing_resources_request->justification = $request->justification;
        $computing_resources_request->additional_info = $request->additional_info;
        $computing_resources_request->status_of_request = 'Pending';
        $computing_resources_request->save();
        $computing_resources_requestid = $computing_resources_request->id;

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $technology_workshop_request_arr = array(
                    'status_of_request' => 'Approved',
                );
                technology_workshop_request::where('id', $computing_resources_requestid)->update($technology_workshop_request_arr);
                $resultrobin= CreateRobinEvent($computing_resources_requestid,"technology_workshop_request");
                if($resultrobin->getData()->success != false)
                {
                    //add invitees
                    if($request->display_name!=null ){
                        $display_name = $request->display_name;
                        $email = $request->email;
                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new technology_workshop_request_invitees;
                            $event_request_invitees->technology_workshop_request_id = $computing_resources_requestid;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();

                        }
                    }

                }else
                {
                    technology_workshop_request::where('id', $computing_resources_requestid)->delete();
                    $response = [
                        'success' => false,
                        'message' => 'Something went wrong with Robins',
                        'robin_message' => $resultrobin->getData()->message,
                    ];
                    $code = 200;
                    return response()->json($response, $code);
                }
            }
        }

        if($is_admin==0){

            $manual = 0;  // because the push notification is being sent by system
            $receiver_id =getAdminIds('id');
            $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
            $receivers_token = array_column($receivers, 'fcm_token');
            $fcm_token = $receivers_token;


            $sender_id = $usersaveddata[0]->id;

            $title = "Technology Workshop Request";
            $body = "user has requested for Technology Workshop";
            if(count($fcm_token) > 0)
            {
                 sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


        }
        $saveddata = technology_workshop_request::where('id', $computing_resources_requestid)->get();
        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "Technology workshop request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }

    public function ideaRequest(Request $request)
    {
        // dd($request->all());
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $idea_request = new idea_request;
        $idea_request->users_id = $usersaveddata[0]->id;
        $idea_request->track_channel = $request->track_channel;
        $idea_request->idea_name = $request->idea_name;

        $idea_request->idea_problem = $request->idea_problem;
        $idea_request->idea_solution = $request->idea_solution;
        $idea_request->idea_resource_requirement = $request->idea_resource_requirement;

        $idea_request->contributors = $request->contributors;
        $idea_request->point_of_contact = $request->point_of_contact;
        $idea_request->technology = $request->technology;
        $idea_request->other_technology = $request->other_technology;
        $idea_request->current_implementation_level = $request->current_implementation_level;
        $file_path = "";

        if ($request->has('attachment')) {

            if (env('STORAGE') == "local") {
                $file = $request->attachment;
                $filename = str_replace('.', '-', $request->idea_name) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->attachment->getClientOriginalExtension();
                $fileup = $file->storeAs('ideaAttachments', $filename, ['disk' => 'my_files']);
                $file_path = env('ASSET_URL') . '/uploads/ideaAttachments/' . $filename;
            }

            if (env('STORAGE') == "s3") {

                $filee = $request->attachment;
                $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $request->attachment, "ideaAttachments/" . $filename, 'public');
                $file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }
        }
        $idea_request->attachment = $file_path;
        $idea_request->status_of_request = 'Pending';


        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $idea_request->status_of_request = 'Approved';
            }
        }
        // $idea_request->date_of_request = $request->date_of_request;
        $idea_request->save();
        $eventrequestid = $idea_request->id;

        if( $is_admin==0){

                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $usersaveddata[0]->id;

                $title = "Idea Request";
                $body = "user has requested to submit an Idea";
                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


            }
        $saveddata = idea_request::where('id', $eventrequestid)->get();
        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "Idea request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }

    public function generalReservation(Request $request)
    {
        // dd($request->all());
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        $general_reservation = new general_reservation;
        $general_reservation->users_id = $usersaveddata[0]->id;
        $general_reservation->title = $request->title;
        $general_reservation->start_date = $request->start_date;
        $general_reservation->end_date = $request->end_date;
        $general_reservation->description = $request->description;
        $general_reservation->justification = $request->justification;
        $general_reservation->status_of_request = 'Pending';

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $is_admin=0;
            if (count($result) > 0) {
                $is_admin=1;
                $general_reservation->status_of_request = 'Approved';
            }
        }

        $general_reservation->save();
        $general_reservationid = $general_reservation->id;

          if($is_admin==0){

                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $usersaveddata[0]->id;

                $title = "General Reservation Request";
                $body = "User has requested for General Reservation";
                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }

        $saveddata = general_reservation::where('id', $general_reservationid)->get();



        $response = [
            'success' => true,
            'data' => $saveddata,
            'message' => "General Reservation Request has been submitted successfully",
        ];
        return response()->json($response, 200);
    }


    public function getAllEventRequests(Request $request)
    {

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
                $eventrequests = event_request::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'event_request.id', 'event_request.event_name', 'event_request.space_name', 'event_request.required_resources', 'event_request.other_required_resource', 'event_request.start_date', 'event_request.end_date', 'event_request.num_of_attendees', 'event_request.coordinator_contact', 'event_request.justification', 'event_request.additional_info', 'event_request.status_of_request', 'event_request.created_at', 'event_request.updated_at')
                    ->join('users', 'event_request.users_id', '=', 'users.id')
                    ->with('event_request_invitees')
                    ->get();



                $response = [
                    'success' => true,
                    'data' => $eventrequests,

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

    public function getAllRequiredResourcesList(Request $request)
    {
        $requiredResource = required_resource_list::select('*')->get();
        $response = [
            'success' => true,
            'data' => $requiredResource,
        ];
        return response()->json($response, 200);
    }

    public function getAllScheduleVisitRequests(Request $request)
    {
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
                $schedulevisitrequests = schedule_visit::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'schedule_visit_request.id', 'schedule_visit_request.visit_title', 'schedule_visit_request.start_date', 'schedule_visit_request.end_date', 'schedule_visit_request.num_of_visitors', 'schedule_visit_request.visitor_coordinator_contact', 'schedule_visit_request.justification', 'schedule_visit_request.additional_info', 'schedule_visit_request.status_of_request', 'schedule_visit_request.created_at', 'schedule_visit_request.updated_at')
                    ->join('users', 'schedule_visit_request.users_id', '=', 'users.id')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $schedulevisitrequests,
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

    public function getAllGeneralReservation(Request $request)
    {
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
                $schedulevisitrequests = general_reservation::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'general_reservation.id', 'general_reservation.title', 'general_reservation.start_date', 'general_reservation.end_date', 'general_reservation.description', 'general_reservation.justification', 'general_reservation.status_of_request', 'general_reservation.flag', 'general_reservation.created_at', 'general_reservation.updated_at')
                    ->join('users', 'general_reservation.users_id', '=', 'users.id')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $schedulevisitrequests,
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

    public function getAllreserveIncubatorRequest(Request $request)
    {
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
                $incubatorrequests = incubator_request::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'incubator_request.id', 'incubator_request.usecase_name', 'incubator_request.space_name', 'incubator_request.start_date', 'incubator_request.end_date', 'incubator_request.contact_of_usecase', 'incubator_request.num_of_employees', 'incubator_request.justification', 'incubator_request.additional_info', 'incubator_request.status_of_request', 'incubator_request.created_at', 'incubator_request.updated_at')
                    ->join('users', 'incubator_request.users_id', '=', 'users.id')
                    ->with('incubator_request_invitees')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $incubatorrequests,

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

    public function getAllComputingResourcesRequest(Request $request)
    {
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
                $computingresourcerequests = computing_resources_request::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'computing_resources_request.id', 'computing_resources_request.usecase_name', 'computing_resources_request.contact_of_usecase', 'computing_resources_request.start_date', 'computing_resources_request.end_date', 'computing_resources_request.num_of_employees', 'computing_resources_request.justification', 'computing_resources_request.additional_info', 'computing_resources_request.status_of_request', 'computing_resources_request.created_at', 'computing_resources_request.updated_at')
                    ->join('users', 'computing_resources_request.users_id', '=', 'users.id')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $computingresourcerequests,
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

    public function getAllTechnologyWorkshopRequest(Request $request)
    {
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
                $technologyworkshoprequests = technology_workshop_request::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'technology_workshop_request.id', 'technology_workshop_request.workshop_name', 'technology_workshop_request.space_name', 'technology_workshop_request.start_date', 'technology_workshop_request.end_date', 'technology_workshop_request.num_of_people', 'technology_workshop_request.point_of_contact', 'technology_workshop_request.justification', 'technology_workshop_request.additional_info', 'technology_workshop_request.status_of_request', 'technology_workshop_request.created_at', 'technology_workshop_request.updated_at')
                    ->join('users', 'technology_workshop_request.users_id', '=', 'users.id')
                    ->with('technology_workshop_request_invitees')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $technologyworkshoprequests,
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

    public function getAllIdeaRequest(Request $request)
    {
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
                $idearequests = idea_request::select('users.google_id as google_id', 'users.first_name as first_name', 'users.email as email', 'idea_request.id',  'idea_request.track_channel', 'idea_request.idea_name', 'idea_request.idea_problem', 'idea_request.idea_solution', 'idea_request.idea_resource_requirement', 'idea_request.contributors', 'idea_request.point_of_contact', 'idea_request.technology', 'idea_request.other_technology', 'idea_request.current_implementation_level', 'idea_request.attachment', 'idea_request.status_of_request', 'idea_request.created_at', 'idea_request.updated_at')
                    ->join('users', 'idea_request.users_id', '=', 'users.id')
                    ->get();
                $response = [
                    'success' => true,
                    'data' => $idearequests,
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

    public function getAllTechnologyList(Request $request)
    {
        $techlist = technology_list::select('*')->get();
        $response = [
            'success' => true,
            'data' => $techlist,
        ];
        return response()->json($response, 200);
    }

    public function getAllCurrentImplementationList(Request $request)
    {
        $implementationList = current_implementation_level::select('*')->get();
        $response = [
            'success' => true,
            'data' => $implementationList,
        ];
        return response()->json($response, 200);
    }

    public function updateEventRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = event_request::find($request->event_id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $event_id =$request->event_id;
                $eventdata = array(
                    'event_name' => $request->event_name,
                    'space_name' => $request->space_name,
                    'required_resources' => $request->required_resources,
                    'other_required_resource' => $request->other_required_resource,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'num_of_attendees' => $request->num_of_attendees,
                    'coordinator_contact' => $request->coordinator_contact,
                    'justification' => $request->justification,
                    'additional_info' => $request->additional_info,
                );
                event_request::where('id', $event_id)->update($eventdata);

                if (count($result) > 0){

                    event_request_invitees::where('event_request_id', $event_id)->delete();
                    if($request->display_name!=null ){

                        $display_name = $request->display_name;
                        $email = $request->email;

                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new event_request_invitees;
                            $event_request_invitees->event_request_id = $event_id;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();
                        }
                    }


                    $adminfeedback="";
                    if($request->feedback){
                        $adminfeedback=" Admin Feedback: ".$request->feedback;
                    }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    // $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Event Request update";
                    $body = "Admin has updated the Event Request ". $adminfeedback;


                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
                       saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }



                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Event Request update";
                    $body = "User has updated the Event Request";
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
                     saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }

//   dd($receiver_id);



                $event = event_request::where('id', $event_id)->get();
                $data['users_id'] = $event[0]->users_id;
                $data['event_name'] = $event[0]->event_name;
                $data['space_name'] = $event[0]->space_name;
                $data['required_resources'] = $event[0]->required_resources;
                $data['other_required_resource'] = $event[0]->other_required_resource;
                $data['start_date'] = $event[0]->start_date;
                $data['end_date'] = $event[0]->end_date;
                $data['num_of_attendees'] = $event[0]->num_of_attendees;
                $data['coordinator_contact'] = $event[0]->coordinator_contact;
                $data['justification'] = $event[0]->justification;
                $data['additional_info'] = $event[0]->additional_info;
                $data['status_of_request'] = $event[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Event Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin or owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeEventRequestStatus(Request $request)
    {

        $readytosend_notfication=0;
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();

        $event_id =$request->event_id;
        $eventdata=event_request::where('id', $event_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {

                $status =$request->status_of_request;
                if($status=="Approved"){
                    $resultrobin = CreateRobinEvent($event_id,"event_request");
                    if($resultrobin->getData()->success)
                    {
                        $readytosend_notfication=1;


                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        event_request::where('id', $event_id)->update($event_request_arr);

                        $response = [
                            'success' => true,
                            'message' => 'Event Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }
                if($status=="Cancelled"){


                    $resultrobin = DeleteRobinEvent($event_id,"event_request");
                    if($resultrobin->getData()->success)
                    {
                        $readytosend_notfication=1;
                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        event_request::where('id', $event_id)->update($event_request_arr);


                        $response = [
                            'success' => true,
                            'message' => 'Event Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }


                $adminfeedback="";


                if($status=="Rejected"){
                    $readytosend_notfication=1;

                    $event_request_arr = array(
                        'status_of_request' => $status,
                    );
                    event_request::where('id', $event_id)->update($event_request_arr);

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                 $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($eventdata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Event Request has been ". $status ;
                    $body = "Admin has ". $status ." your event request.". $adminfeedback;

                    if($readytosend_notfication==1){

                            if(count($fcm_token) > 0)
                            {
                                sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                            }
                             saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }



                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Event Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }



        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateScheduleVisitRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = schedule_visit::find($request->schedule_visit_id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $schedule_visit_id =$request->schedule_visit_id;
                $eventdata = array(
                    'visit_title' => $request->visit_title,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'num_of_visitors' => $request->num_of_visitors,
                    'visitor_coordinator_contact' => $request->visitor_coordinator_contact,
                    'justification' => $request->justification,
                    'additional_info' => $request->additional_info,
                );

                schedule_visit::where('id', $schedule_visit_id)->update($eventdata);


                $adminfeedback="";
                    if($request->feedback){
                        $adminfeedback=" Admin Feedback: ".$request->feedback;
                    }

                if($owner->users_id == $userid){




                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');

                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Schedule Request update";
                    $body = "User has updated the Schedule Request";
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }


                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIN('id', $receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Schedule Request update";
                    $body = "Admin has updated the Schedule Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }






                $schedule_visit = schedule_visit::where('id', $schedule_visit_id)->get();
                $data['users_id'] = $schedule_visit[0]->users_id;
                $data['visit_title'] = $schedule_visit[0]->visit_title;
                $data['start_date'] = $schedule_visit[0]->start_date;
                $data['end_date'] = $schedule_visit[0]->end_date;
                $data['num_of_visitors'] = $schedule_visit[0]->num_of_visitors;
                $data['visitor_coordinator_contact'] = $schedule_visit[0]->visitor_coordinator_contact;
                $data['justification'] = $schedule_visit[0]->justification;
                $data['additional_info'] = $schedule_visit[0]->additional_info;
                $data['status_of_request'] = $schedule_visit[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Schedule Visit Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeScheduleVisitRequestStatus(Request $request)
    {
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
                $schedule_visit_id =$request->schedule_visit_id;
                $status =$request->status_of_request;
                $event_request_arr = array(
                    'status_of_request' => $status,
                );
                schedule_visit::where('id', $schedule_visit_id)->update($event_request_arr);


                $schdata=schedule_visit::where('id', $schedule_visit_id)->get();

                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($schdata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Event Request has been ". $status ;
                    $body = "Admin has ". $status ." your event request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);








                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Schedule Visit Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateGeneralReservation(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = general_reservation::find($request->id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $id = $request->id;
                $eventdata = array(
                    'title' => $request->title,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'description' => $request->description,
                    'justification' => $request->justification,
                );
                general_reservation::where('id', $id)->update($eventdata);
                $general_reservation = general_reservation::where('id', $id)->get();
                $data['users_id'] = $general_reservation[0]->users_id;
                $data['title'] = $general_reservation[0]->title;
                $data['start_date'] = $general_reservation[0]->start_date;
                $data['end_date'] = $general_reservation[0]->end_date;
                $data['description'] = $general_reservation[0]->description;
                $data['justification'] = $general_reservation[0]->justification;
                $data['status_of_request'] = $general_reservation[0]->status_of_request;
                $data['flag'] = $general_reservation[0]->flag;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "General Reservation Request Changed successfully",
                ];


                $adminfeedback="";
                    if($request->feedback){
                        $adminfeedback=" Admin Feedback: ".$request->feedback;
                    }




                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "General Reservation Request update";
                    $body = "User has updated the General Reservation Request";
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }


                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "General Reservation Request update";
                    $body = "Admin has updated the General Reservation Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }




                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeGeneralReservationStatus(Request $request)
    {
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
                $id =$request->id;
                $status =$request->status_of_request;
                $event_request_arr = array(
                    'status_of_request' => $status,
                );
                general_reservation::where('id', $id)->update($event_request_arr);




                $saveddata=general_reservation::where('id', $id)->get();

                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($saveddata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "General Visit Request has been ". $status ;
                    $body = "Admin has ". $status ." your General Visit request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);










                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "General Visit Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateReserveIncubatorRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = incubator_request::find($request->reserve_incubator_id);
            if (count($result) > 0 || $owner->users_id == $userid ) {
                $reserve_incubator_id =$request->reserve_incubator_id;
                $eventdata = array(
                    'usecase_name' => $request->usecase_name,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'num_of_employees' => $request->num_of_employees,
                    'contact_of_usecase' => $request->contact_of_usecase,
                    'justification' => $request->justification,
                    'additional_info' => $request->additional_info,
                );
                incubator_request::where('id', $reserve_incubator_id)->update($eventdata);

                if($request->space_name!=""){
                    $space_name = array(
                        'space_name' => $request->space_name,
                        );
                    incubator_request::where('id', $reserve_incubator_id)->update($space_name);
                }
                if (count($result) > 0){
                    incubator_request_invitees::where('incubator_request_id', $reserve_incubator_id)->delete();
                    if($request->display_name!=null ){

                        $display_name = $request->display_name;
                        $email = $request->email;
                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new incubator_request_invitees;
                            $event_request_invitees->incubator_request_id = $reserve_incubator_id;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();
                        }
                    }
                }



                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Reserve Incubator Request update";
                    $body = "User has updated the Reserve Incubator Request";
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }



                $adminfeedback="";
                if($request->feedback){
                    $adminfeedback=" Admin Feedback: ".$request->feedback;
                }


                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Reserve Incubator Request update";
                    $body = "Admin has updated the Reserve Incubator Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }


                $schedule_visit = incubator_request::where('id', $reserve_incubator_id)->get();
                $data['users_id'] = $schedule_visit[0]->users_id;
                $data['usecase_name'] = $schedule_visit[0]->usecase_name;
                $data['space_name'] = $schedule_visit[0]->space_name;
                $data['start_date'] = $schedule_visit[0]->start_date;
                $data['end_date'] = $schedule_visit[0]->end_date;
                $data['num_of_employees'] = $schedule_visit[0]->num_of_employees;
                $data['contact_of_usecase'] = $schedule_visit[0]->contact_of_usecase;
                $data['justification'] = $schedule_visit[0]->justification;
                $data['additional_info'] = $schedule_visit[0]->additional_info;
                $data['status_of_request'] = $schedule_visit[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Reserve Incubator Updated successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeReserveIncubatorRequestStatus(Request $request)
    {

        $readytosend_notfication=0;
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
                $reserve_incubator_id =$request->reserve_incubator_id;
                $status =$request->status_of_request;

                if($status=="Approved"){
                    $resultrobin = CreateRobinEvent($reserve_incubator_id,"incubator_request");


                    if($resultrobin->getData()->success)
                    {

                        $readytosend_notfication=1;

                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        incubator_request::where('id', $reserve_incubator_id)->update($event_request_arr);

                        $response = [
                            'success' => true,
                            'message' => 'Incubator Request Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }
                if($status=="Cancelled"){
                    $resultrobin = DeleteRobinEvent($reserve_incubator_id,"incubator_request");
                    if($resultrobin->getData()->success)
                    {

                        $readytosend_notfication=1;
                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        incubator_request::where('id', $reserve_incubator_id)->update($event_request_arr);

                        $response = [
                            'success' => true,
                            'message' => 'Incubator Request Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }

                $saveddata=incubator_request::where('id', $reserve_incubator_id)->get();

                $adminfeedback="";


                if($status=="Rejected"){

                    $readytosend_notfication=1;


                    $event_request_arr = array(
                        'status_of_request' => $status,
                    );
                    incubator_request::where('id', $reserve_incubator_id)->update($event_request_arr);

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($saveddata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Reserve Incubator Request has been ". $status ;
                    $body = "Admin has ". $status ." your Reserve Incubator request.". $adminfeedback;

                    if($readytosend_notfication==1){
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }
                   saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                }








                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Reserve Incubator Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateComputingResourceRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = computing_resources_request::find($request->computing_resource_id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $computing_resource_id =$request->computing_resource_id;
                $eventdata = array(
                    'usecase_name' => $request->usecase_name,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'num_of_employees' => $request->num_of_employees,
                    'contact_of_usecase' => $request->contact_of_usecase,
                    'justification' => $request->justification,
                    'additional_info' => $request->additional_info,
                );
                computing_resources_request::where('id', $computing_resource_id)->update($eventdata);





                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Computing Resource Request update";
                    $body = "User has updated the Computing Resource Request";
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }



                $adminfeedback="";
                if($request->feedback){
                    $adminfeedback=" Admin Feedback: ".$request->feedback;
                }


                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Computing Resource Request update";
                    $body = "Admin has updated the Computing Resource Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }


                $schedule_visit = computing_resources_request::where('id', $computing_resource_id)->get();
                $data['users_id'] = $schedule_visit[0]->users_id;
                $data['usecase_name'] = $schedule_visit[0]->usecase_name;
                $data['start_date'] = $schedule_visit[0]->start_date;
                $data['end_date'] = $schedule_visit[0]->end_date;
                $data['num_of_employees'] = $schedule_visit[0]->num_of_employees;
                $data['contact_of_usecase'] = $schedule_visit[0]->contact_of_usecase;
                $data['justification'] = $schedule_visit[0]->justification;
                $data['additional_info'] = $schedule_visit[0]->additional_info;
                $data['status_of_request'] = $schedule_visit[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Computing Resource Request Updated successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeComputingResourceRequestStatus(Request $request)
    {
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
                $computing_resource_id =$request->computing_resource_id;
                $status =$request->status_of_request;
                $event_request_arr = array(
                    'status_of_request' => $status,
                );
                computing_resources_request::where('id', $computing_resource_id)->update($event_request_arr);








                $saveddata=computing_resources_request::where('id', $computing_resource_id)->get();

                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($saveddata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Computing Resource Request has been ". $status ;
                    $body = "Admin has ". $status ." your Computing Resource request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);












                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Computing Resource Request Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateTechnologyWorkshopRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = technology_workshop_request::find($request->technology_workshop_id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $technology_workshop_id =$request->technology_workshop_id;
                $eventdata = array(
                    'workshop_name' => $request->workshop_name,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'num_of_people' => $request->num_of_people,
                    'point_of_contact' => $request->point_of_contact,
                    'justification' => $request->justification,
                    'additional_info' => $request->additional_info,
                );
                technology_workshop_request::where('id', $technology_workshop_id)->update($eventdata);




                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Technology Workshop Request update";
                    $body = "User has updated the Technology Workshop Request";
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }


                $adminfeedback="";
                if($request->feedback){
                    $adminfeedback=" Admin Feedback: ".$request->feedback;
                }



                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Technology Workshop Request update";
                    $body = "Admin has updated the Technology Workshop Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }






                if($request->space_name!=""){
                    $space_name = array(
                        'space_name' => $request->space_name,
                        );
                        technology_workshop_request::where('id', $technology_workshop_id)->update($space_name);
                }

                if (count($result) > 0){
                    technology_workshop_request_invitees::where('technology_workshop_request_id', $technology_workshop_id)->delete();
                    if($request->display_name!=null ){

                        $display_name = $request->display_name;
                        $email = $request->email;
                        foreach($display_name as $key=>$value){
                            $event_request_invitees = new technology_workshop_request_invitees;
                            $event_request_invitees->technology_workshop_request_id = $technology_workshop_id;
                            $event_request_invitees->display_name = $display_name[$key];
                            $event_request_invitees->email = $email[$key];
                            $event_request_invitees->save();
                        }
                    }
                }
                $schedule_visit = technology_workshop_request::where('id', $technology_workshop_id)->get();
                $data['users_id'] = $schedule_visit[0]->users_id;
                $data['workshop_name'] = $schedule_visit[0]->workshop_name;
                $data['space_name'] = $schedule_visit[0]->space_name;
                $data['start_date'] = $schedule_visit[0]->start_date;
                $data['end_date'] = $schedule_visit[0]->end_date;
                $data['num_of_people'] = $schedule_visit[0]->num_of_people;
                $data['point_of_contact'] = $schedule_visit[0]->point_of_contact;
                $data['justification'] = $schedule_visit[0]->justification;
                $data['additional_info'] = $schedule_visit[0]->additional_info;
                $data['status_of_request'] = $schedule_visit[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Technology Workshop Request Updated successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeTechnologyWorkshopRequestStatus(Request $request)
    {
        $readytosend_notfication=0;

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
                $technology_workshop_id =$request->technology_workshop_id;
                $status =$request->status_of_request;


                if($status=="Approved"){
                    $resultrobin = CreateRobinEvent($technology_workshop_id,"technology_workshop_request");
                    if($resultrobin->getData()->success)
                    {

                        $readytosend_notfication=1;


                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        technology_workshop_request::where('id', $technology_workshop_id)->update($event_request_arr);

                        $response = [
                            'success' => true,
                            'message' => 'Technology Workshop Request Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }
                if($status=="Cancelled"){
                    $resultrobin = DeleteRobinEvent($technology_workshop_id,"technology_workshop_request");
                    if($resultrobin->getData()->success)
                    {

                        $readytosend_notfication=1;



                        $event_request_arr = array(
                            'status_of_request' => $status,
                        );
                        technology_workshop_request::where('id', $technology_workshop_id)->update($event_request_arr);


                        $response = [
                            'success' => true,
                            'message' => 'Technology Workshop Request Status Changed successfully',
                            'data' => $resultrobin->getData()->data,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'msg' => $resultrobin->getData()->message->message ?? $resultrobin->getData()->message,
                            'message' => $resultrobin->getData()->message,
                            'data' => $resultrobin->getData()->data ?? null,
                        ];
                        $code = 200;
                        return response()->json($response, $code);
                    }
                }

                $saveddata=technology_workshop_request::where('id', $technology_workshop_id)->get();

                $adminfeedback="";


                if($status=="Rejected"){


                    $readytosend_notfication=1;



                    $event_request_arr = array(
                        'status_of_request' => $status,
                    );
                    technology_workshop_request::where('id', $technology_workshop_id)->update($event_request_arr);

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($saveddata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Technology Workshop Request has been ". $status ;
                    $body = "Admin has ". $status ." your Technology Workshop request.". $adminfeedback;


                    if($readytosend_notfication==1){
                            if(count($fcm_token) > 0)
                            {
                                sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                            }

                            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }






                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Technology Workshop Request Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function updateIdeaRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = idea_request::find($request->idea_id);
            if (count($result) > 0 || $owner->users_id == $userid) {
                $idea_id =$request->idea_id;

                if ($request->hasFile('attachment')) {
                    $file_path = "";
                    if (env('STORAGE') == "local") {
                        $file = $request->attachment;
                        $filename = str_replace('.', '-', $request->idea_id) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->attachment->getClientOriginalExtension();
                        $fileup = $file->storeAs('ideaAttachments', $filename, ['disk' => 'my_files']);
                        $file_path = env('ASSET_URL') . '/uploads/ideaAttachments/' . $filename;;
                    }

                    if (env('STORAGE') == "s3") {
                        $filee = $request->attachment;
                        $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                        $path = Storage::disk('s3')->putFileAs('', $request->attachment, "ideaAttachments/" . $filename, 'public');
                        $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                    }

                    $ideaAttachmet = array(
                        'attachment' => $file_path,
                    );
                    idea_request::where('id', $idea_id)->update($ideaAttachmet);
                }
                $eventdata = array(
                    'track_channel' => $request->track_channel,
                    'idea_name' => $request->idea_name,

                    'idea_problem' => $request->idea_problem,
                    'idea_solution' => $request->idea_solution,
                    'idea_resource_requirement' => $request->idea_resource_requirement,

                    'contributors' => $request->contributors,
                    'technology' => $request->technology,
                    'other_technology' => $request->other_technology,
                    'point_of_contact' => $request->point_of_contact,
                    'current_implementation_level' => $request->current_implementation_level,
                );
                idea_request::where('id', $idea_id)->update($eventdata);










                if($owner->users_id == $userid){

                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =getAdminIds('id');
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Idea Request update";
                    $body = "User has updated the Idea Request";
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }


                $adminfeedback="";
                if($request->feedback){
                    $adminfeedback=" Admin Feedback: ".$request->feedback;
                }

                if (count($result) > 0){
                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($owner->users_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Idea Request update";
                    $body = "Admin has updated the Idea Request ".$adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                 }















                $schedule_visit = idea_request::where('id', $idea_id)->get();
                $data['users_id'] = $schedule_visit[0]->users_id;
                $data['track_channel'] = $schedule_visit[0]->track_channel;
                $data['idea_name'] = $schedule_visit[0]->idea_name;

                $data['idea_problem'] = $schedule_visit[0]->idea_problem;
                $data['idea_solution'] = $schedule_visit[0]->idea_solution;
                $data['idea_resource_requirement'] = $schedule_visit[0]->idea_resource_requirement;

                $data['contributors'] = $schedule_visit[0]->contributors;
                $data['technology'] = $schedule_visit[0]->technology;
                $data['other_technology'] = $schedule_visit[0]->other_technology;
                $data['point_of_contact'] = $schedule_visit[0]->point_of_contact;
                $data['current_implementation_level'] = $schedule_visit[0]->current_implementation_level;
                $data['attachment'] = $schedule_visit[0]->attachment;
                $data['status_of_request'] = $schedule_visit[0]->status_of_request;
                $response = [
                    'success' => true,
                    'data'    => $data,
                    'message' => "Idea Request Updated successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function ChangeIdeaRequestStatus(Request $request)
    {
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
                $idea_id =$request->idea_id;
                $status =$request->status_of_request;
                $event_request_arr = array(
                    'status_of_request' => $status,
                );
                idea_request::where('id', $idea_id)->update($event_request_arr);




                $saveddata=idea_request::where('id', $idea_id)->get();

                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($saveddata[0]->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Idea Request has been ". $status ;
                    $body = "Admin has ". $status ." your Idea request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);








                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => "Idea Request Status Changed successfully",
                ];
                return response()->json($response, 200);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function checkExcitingEvent(Request $request)
    {
        if($request->space_name && $request->start_date && $request->end_date)
        {
            $startdate = date('Y-m-d H:i:s', strtotime($request->start_date));
            $enddate = date('Y-m-d H:i:s', strtotime($request->end_date));
            $spacename = $request->space_name;

            $event = event_request::where('space_name',$spacename)
            ->where(function($q) use($startdate,$enddate){
                $q->where(function($query) use($startdate,$enddate){
                    $query->where('start_date','>=',$startdate)
                        ->where('start_date','<=',$enddate);
                    });
                    $q->orWhere(function($query) use($startdate,$enddate){
                        $query->where('end_date','>=',$startdate)
                        ->where('end_date','<=',$enddate);
                    });
//                     $q->orWhere(function($query) use($startdate,$enddate){
//                         $query->where('start_date','<=',$startdate)
//                         ->where('end_date','>=',$enddate);
//                     });
                    $q->orWhere(function($query) use($startdate, $enddate){
                        $query->where('start_date','=',$startdate)
                            ->where('end_date','=',$enddate);
                    });
            })
            ->where(function($query){
                $query->where('status_of_request','Approved')
                    ->orWhere('status_of_request','Pending');
            });
            if($request->id != null)
            {
                $event = $event->whereNot('id',$request->id);
            }
            $event = $event->get()->toArray();

            if(count($event) > 0)
            {
                $response = [
                    'success' => false,
                    'message' => 'Booking Already done for given space, date and time by below event',
                    'data' => $event[0]['event_name'],
                    'id' => $event[0]['id'],
                ];
                $code = 200;
                return response()->json($response, $code);
            }
            else
            {
                $response = [
                    'success' => true,
                    'message' => 'No Booking Found for given space, date and time',
                ];
                $code = 200;
                return response()->json($response, $code);
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Space Name, StartDate & EndDate is required!',
            ];
            $code = 200;
            return response()->json($response, $code);
        }
    }

    public function getUserActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_id' => 'required',
            'request_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 401);
        }

        $getUser = User::where('google_id', $request->google_id)->first();

        if (empty($getUser)) {
            return response()->json([
                'success' => false,
                'message' => 'The google id does not exist'
            ], 404);
        }

        $getData = "";
        switch ($request->request_type) {
            case "event":
                $getData = event_request::with('event_request_invitees')->where('users_id', $getUser->id)->get();
                break;
            case "visit":
                $getData = schedule_visit::where('users_id', $getUser->id)->get();
                break;
            case "resource":
                $getData = computing_resources_request::where('users_id', $getUser->id)->get();
                break;
            case "workshop":
                $getData = technology_workshop_request::with('technology_workshop_request_invitees')->where('users_id', $getUser->id)->get();
                break;
            case "incubator":
                $getData = incubator_request::with('incubator_request_invitees')->where('users_id', $getUser->id)->get();
                break;
            case "idea":
                $getData = idea_request::where('users_id', $getUser->id)->get();
                break;
            case "general":
                $getData = general_reservation::where('users_id', $getUser->id)->get();
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid request type'
                ], 404);
        }

        if (count($getData) == 0) {
            return response()->json([
                'success' => true,
                'message' => 'You did not make any requests yet'
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => $getData
            ], 200);
        }
    }

    public function checkExistingIncubatorRequest(Request $request)
    {
        if($request->space_name && $request->start_date && $request->end_date)
        {
            $startdate = date('Y-m-d H:i:s', strtotime($request->start_date));
            $enddate = date('Y-m-d H:i:s', strtotime($request->end_date));
            $spacename = $request->space_name;

            $incubator = incubator_request::where('space_name',$spacename)
            ->where(function($q) use($startdate,$enddate){
                $q->where(function($query) use($startdate,$enddate){
                    $query->where('start_date','>=',$startdate)
                        ->where('start_date','<=',$enddate);
                });
                $q->orWhere(function($query) use($startdate,$enddate){
                    $query->where('end_date','>=',$startdate)
                    ->where('end_date','<=',$enddate);
                });
                // $q->orWhere(function($query) use($startdate,$enddate){
                //     $query->where('start_date','<=',$startdate)
                //     ->where('end_date','>=',$enddate);
                // });
                $q->orWhere(function($query) use($startdate, $enddate){
                    $query->where('start_date','=',$startdate)
                        ->where('end_date','=',$enddate);
                });
            })
            ->where(function($query){
                $query->where('status_of_request','Approved')
                    ->orWhere('status_of_request','Pending');
            });
            if($request->id != null)
            {
                $incubator = $incubator->whereNot('id',$request->id);
            }
            $incubator = $incubator->get()->toArray();

            if(count($incubator) > 0)
            {
                $response = [
                    'success' => false,
                    'message' => 'Booking Already done for given space, date and time by below Incubator request',
                    'data' => $incubator[0]['usecase_name'],
                    'id' => $incubator[0]['id'],
                ];
                $code = 200;
                return response()->json($response, $code);
            }
            else
            {
                $response = [
                    'success' => true,
                    'message' => 'No Booking Found for given space, date and time',
                ];
                $code = 200;
                return response()->json($response, $code);
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Space Name, StartDate & EndDate is required!',
            ];
            $code = 200;
            return response()->json($response, $code);
        }
    }


    public function checkExistingWorkshopRequest(Request $request)
    {
        if($request->space_name && $request->start_date && $request->end_date)
        {
            $startdate = date('Y-m-d H:i:s', strtotime($request->start_date));
            $enddate = date('Y-m-d H:i:s', strtotime($request->end_date));
            $spacename = $request->space_name;

            $tech_workshop = technology_workshop_request::where('space_name',$spacename)
            ->where(function($q) use($startdate,$enddate){
                $q->where(function($query) use($startdate,$enddate){
                    $query->where('start_date','>=',$startdate)
                        ->where('start_date','<=',$enddate);
                });
                $q->orWhere(function($query) use($startdate,$enddate){
                    $query->where('end_date','>=',$startdate)
                    ->where('end_date','<=',$enddate);
                });
                // $q->orWhere(function($query) use($startdate,$enddate){
                //     $query->where('start_date','<=',$startdate)
                //     ->where('end_date','>=',$enddate);
                // });
                $q->orWhere(function($query) use($startdate, $enddate){
                    $query->where('start_date','=',$startdate)
                        ->where('end_date','=',$enddate);
                });
            })
            ->where(function($query){
                $query->where('status_of_request','Approved')
                    ->orWhere('status_of_request','Pending');
            });
            if($request->id != null)
            {
                $tech_workshop = $tech_workshop->whereNot('id',$request->id);
            }
            $tech_workshop = $tech_workshop->get()->toArray();

            if(count($tech_workshop) > 0)
            {
                $response = [
                    'success' => false,
                    'message' => 'Booking Already done for given space, date and time by below workshop request',
                    'data' => $tech_workshop[0]['workshop_name'],
                    'id' => $tech_workshop[0]['id'],
                ];
                $code = 200;
                return response()->json($response, $code);
            }
            else
            {
                $response = [
                    'success' => true,
                    'message' => 'No Booking Found for given space, date and time',
                ];
                $code = 200;
                return response()->json($response, $code);
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => 'Space Name, StartDate & EndDate is required!',
            ];
            $code = 200;
            return response()->json($response, $code);
        }
    }


    public function cancelEventRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $event = event_request::find($request->id);
            $id =$request->id;
            // if (count($result) > 0) {
            //     $event_request_arr = array(
            //         'status_of_request' => 'Cancelled',
            //     );
            //     $resultrobin =  DeleteRobinEvent($id,"event_request");
            //     if($resultrobin->getData()->success != false)
            //     {
            //         event_request::where('id', $id)->update($event_request_arr);
            //         $response = [
            //             'success' => true,
            //             'message' => "Cancelled successfully",
            //             'cancelled' => 1,
            //         ];
            //     }else{
            //         $response = [
            //             'success' => false,
            //             'message' => 'Something went wrong with Robins',
            //             'robin_message' => $resultrobin->getData()->message,
            //         ];
            //     }
            //     $code = 200;
            //     return response()->json($response, $code);
            // }else


                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;
                $title = "Event Cancellation Request";
                $pushbody = "";


            if($event->users_id == $userid)
            {
                if($event->status_of_request == 'Pending')
                {
                    $event_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"event_request");
                    if($resultrobin->getData()->success != false)
                    {
                        event_request::where('id', $id)->update($event_request_arr);
                        $response = [
                            'success' => true,
                            'message' => "Cancelled successfully",
                            'cancelled' => 1,
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }
                    $code = 200;
                    $pushbody = "User has requested for Event Cancellation before its Approval.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    return response()->json($response, $code);


                }
                elseif($event->status_of_request == 'Approved')
                {
                    $event_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    event_request::where('id', $id)->update($event_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];
                    $code = 200;
                    $pushbody = "User has requested for Event Cancellation.";

                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }


            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    return response()->json($response, $code);
                }









            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelEventRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $event = event_request::find($request->id);
            $id =$request->id;
            $status =$request->cancellation_request;
            if (count($result) > 0 &&  $event->is_cancelled == 'Cancelled') {
                // if (count($result) > 0) {
                if($status == 'Approved')
                {
                    $event_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"event_request");
                    if($resultrobin->getData()->success != false)
                    {
                        event_request::where('id', $id)->update($event_request_arr);
                        // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                        $response = [
                            'success' => true,
                            'message' => "Event Cancelled successfully",
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }
                    $code = 200;
                    return response()->json($response, $code);
                }elseif($status == 'Rejected')
                {
                    $event_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    event_request::where('id', $id)->update($event_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Event Cancellation Rejected!",
                    ];
                    $code = 200;
                    return response()->json($response, $code);
                }





                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($event->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Event Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Event Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);







            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllEventCancellations(Request $request)
    {
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
                $event = event_request::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->get();
                $response = [
                    'success' => true,
                    'data' => $event,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelWorkshopRequest(Request $request)
    {



                 $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');
                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;
                $title = "Workshop Cancellation Request";
                $pushbody = "";






        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            // $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            // $userroles_ = str_replace(" ", "_", $userroles);
            // $rolesarr = explode(",", $userroles_);
            // $authorized_roles = array("Super_Admin", "Admin");
            // $result = array_intersect($authorized_roles, $rolesarr);
            $workshop = technology_workshop_request::find($request->id);
            $id =$request->id;

            if($workshop->users_id == $userid)
            {
                if($workshop->status_of_request == 'Pending')
                {
                    $workshop_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"technology_workshop_request");
                    if($resultrobin->getData()->success != false)
                    {
                        technology_workshop_request::where('id', $id)->update($workshop_request_arr);
                        $response = [
                            'success' => true,
                            'message' => "Cancelled successfully",
                            'cancelled' => 1,
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }


                    $pushbody = "User has requested for Workshop Cancellation before its Approval.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);







                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($workshop->status_of_request == 'Approved')
                {
                    $workshop_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    technology_workshop_request::where('id', $id)->update($workshop_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];

                    $pushbody = "User has requested for Workshop Cancellation.";

                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelWorkshopRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $workshop = technology_workshop_request::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $workshop->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $workshop_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"technology_workshop_request");
                    if($resultrobin->getData()->success != false)
                    {
                        technology_workshop_request::where('id', $id)->update($workshop_request_arr);
                        // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                        $response = [
                            'success' => true,
                            'message' => "Technology Workshop Request Cancelled successfully",
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }

                }elseif($status == 'Rejected')
                {
                    $workshop_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    technology_workshop_request::where('id', $id)->update($workshop_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Technology Workshop Request Cancellation Rejected!",
                    ];

                }



                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($workshop->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Workshop Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Workshop Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);



                    $code = 200;
                    return response()->json($response, $code);

            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllWorkshopCancellations(Request $request)
    {
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
                $workshop = technology_workshop_request::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $workshop,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelIncubatorRequest(Request $request)
    {

        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;
        $title = "Incubator Cancellation Request";
        $pushbody = "";



        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $incubator = incubator_request::find($request->id);
            $id =$request->id;
            if($incubator->users_id == $userid)
            {
                if($incubator->status_of_request == 'Pending')
                {
                    $incubator_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"incubator_request");
                    if($resultrobin->getData()->success != false)
                    {
                        incubator_request::where('id', $id)->update($incubator_request_arr);
                        $response = [
                            'success' => true,
                            'message' => "Cancelled successfully",
                            'cancelled' => 1,
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }



                    $pushbody = "User has requested for Incubator Cancellation before its Approval.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($incubator->status_of_request == 'Approved')
                {
                    $incubator_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    incubator_request::where('id', $id)->update($incubator_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];





                $pushbody = "User has requested for Incubator Cancellation.";

                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelIncubatorRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $incubator = incubator_request::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $incubator->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $incubator_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );
                    $resultrobin =  DeleteRobinEvent($id,"incubator_request");
                    if($resultrobin->getData()->success != false)
                    {
                        incubator_request::where('id', $id)->update($incubator_request_arr);
                        // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                        $response = [
                            'success' => true,
                            'message' => "Incubator Request Cancelled successfully",
                        ];
                    }else{
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong with Robins',
                            'robin_message' => $resultrobin->getData()->message,
                        ];
                    }

                }elseif($status == 'Rejected')
                {
                    $incubator_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    incubator_request::where('id', $id)->update($incubator_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Incubator Request Cancellation Rejected!",
                    ];

                }




                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($incubator->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Incubator Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Incubator Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    $code = 200;
                    return response()->json($response, $code);

            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllIncubatorCancellations(Request $request)
    {
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
                $incubator = incubator_request::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $incubator,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelVisitRequest(Request $request)
    {



        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;
        $title = "Visit Cancellation Request";
        $pushbody = "";



        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $visit = schedule_visit::find($request->id);
            $id =$request->id;
            if($visit->users_id == $userid)
            {
                if($visit->status_of_request == 'Pending')
                {
                    $visit_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    schedule_visit::where('id', $id)->update($visit_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancelled successfully",
                        'cancelled' => 1,
                    ];



                                $pushbody = "User has requested for Visit Cancellation before its Approval.";



                                if(count($fcm_token) > 0)
                                {
                                     sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                                }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($visit->status_of_request == 'Approved')
                {
                    $visit_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    schedule_visit::where('id', $id)->update($visit_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];


                    $pushbody = "User has requested for Visit Cancellation.";



                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelVisitRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $schedule_visit = schedule_visit::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $schedule_visit->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $schedule_visit_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );

                    schedule_visit::where('id', $id)->update($schedule_visit_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Visit Request Cancelled successfully",
                    ];


                }elseif($status == 'Rejected')
                {
                    $schedule_visit_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    schedule_visit::where('id', $id)->update($schedule_visit_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Visit Request Cancellation Rejected!",
                    ];

                }



                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }

                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($schedule_visit->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Schedule Visit Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Schedule Visit Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);


                    $code = 200;
                    return response()->json($response, $code);

            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllVisitCancellations(Request $request)
    {
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
                $schedule_visit = schedule_visit::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $schedule_visit,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelComputingResourceRequest(Request $request)
    {



        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;
        $title = "Computing Resource Cancellation Request";
        $pushbody = "";

        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $computing = computing_resources_request::find($request->id);
            $id =$request->id;
            if($computing->users_id == $userid)
            {
                if($computing->status_of_request == 'Pending')
                {
                    $computing_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    computing_resources_request::where('id', $id)->update($computing_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancelled successfully",
                        'cancelled' => 1,
                    ];





                        $pushbody = "User has requested for Computing Resource Cancellation before its Approval.";



                        if(count($fcm_token) > 0)
                        {
                             sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                        }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);



                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($computing->status_of_request == 'Approved')
                {
                    $computing_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    computing_resources_request::where('id', $id)->update($computing_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];



                    $pushbody = "User has requested for Computing Resource Cancellation.";



                    if(count($fcm_token) > 0)
                    {
                        sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);



                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelComputingResourceRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $computing_resources_request = computing_resources_request::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $computing_resources_request->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $computing_resources_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );

                    computing_resources_request::where('id', $id)->update($computing_resources_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Computing Resource Request Cancelled successfully",
                    ];


                }elseif($status == 'Rejected')
                {
                    $computing_resources_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    computing_resources_request::where('id', $id)->update($computing_resources_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Computing Resource Request Cancellation Rejected!",
                    ];

                }



                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($computing_resources_request->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Computing Resources Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Computing Resources Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);


                    $code = 200;
                    return response()->json($response, $code);

            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllComputingResourceCancellations(Request $request)
    {
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
                $computing_resources_request = computing_resources_request::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $computing_resources_request,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelIdeaRequest(Request $request)
    {


        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;
        $title = "Idea Request Cancellation";
        $pushbody = "";

        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $idea = idea_request::find($request->id);
            $id =$request->id;
            if($idea->users_id == $userid)
            {
                if($idea->status_of_request == 'Pending')
                {
                    $idea_request_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    idea_request::where('id', $id)->update($idea_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancelled successfully",
                        'cancelled' => 1,
                    ];


                    $pushbody = "User has requested for Idea request Cancellation before its Approval.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);



                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($idea->status_of_request == 'Approved')
                {
                    $idea_request_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    idea_request::where('id', $id)->update($idea_request_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];



                    $pushbody = "User has requested for Idea request Cancellation.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);




                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelIdeaRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $idea_request = idea_request::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $idea_request->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $idea_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );

                    idea_request::where('id', $id)->update($idea_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Idea Request Cancelled successfully",
                    ];


                }elseif($status == 'Rejected')
                {
                    $idea_request_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    idea_request::where('id', $id)->update($idea_request_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "Idea Request Cancellation Rejected!",
                    ];

                }


                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($idea_request->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "Idea Cancellation Request has been ". $status ;
                    $body = "Admin has ". $status ." your Idea Cancellation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);


                    $code = 200;
                    return response()->json($response, $code);

            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllIdeaCancellations(Request $request)
    {
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
                $idea_request = idea_request::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $idea_request,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function cancelGeneralReservationRequest(Request $request)
    {


        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;
        $title = "General Reservation Cancellation Request";
        $pushbody = "";



        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $general_reservation = general_reservation::find($request->id);
            $id =$request->id;
            if($general_reservation->users_id == $userid)
            {
                if($general_reservation->status_of_request == 'Pending')
                {
                    $general_reservation_arr = array(
                        'status_of_request' => 'Cancelled',
                        'is_cancelled' => 'Cancelled',
                    );
                    general_reservation::where('id', $id)->update($general_reservation_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancelled successfully",
                        'cancelled' => 1,
                    ];




                    $pushbody = "User has requested for General Reservation Cancellation before its Approval.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);





                    $code = 200;
                    return response()->json($response, $code);
                }
                elseif($general_reservation->status_of_request == 'Approved')
                {
                    $general_reservation_arr = array(
                        'is_cancelled' => 'Cancelled',
                        'is_approval_needed' => 1,
                        'is_cancellation_approved' => 'Pending',
                    );

                    general_reservation::where('id', $id)->update($general_reservation_arr);
                    $response = [
                        'success' => true,
                        'message' => "Cancellation request has been sent",
                        'cancelled' => 0,
                    ];


                    $pushbody = "User has requested for General Reservation Cancellation.";



                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);

                    }

            saveNotificationsDB($title,$pushbody,$fcm_token,$manual,$receiver_id,$userid);





                    $code = 200;
                    return response()->json($response, $code);
                }

            }else{
                $error = 'This user must have rights of Super admin or Owner to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function approveCancelGeneralReservationRequest(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $id =$request->id;
            $general_reservation = general_reservation::find($id);
            $status =$request->cancellation_request;
            if (count($result) > 0 && $general_reservation->is_cancelled == 'Cancelled') {
                if($status == 'Approved')
                {
                    $general_reservation_arr = array(
                        'is_cancellation_approved' => $status,
                        'status_of_request' => 'Cancelled',
                    );

                    general_reservation::where('id', $id)->update($general_reservation_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "General Reservation Request Cancelled successfully",
                    ];


                }elseif($status == 'Rejected')
                {
                    $general_reservation_arr = array(
                        'is_cancellation_approved' => $status,
                        'is_cancelled' => null,
                        'is_approval_needed' => 0,
                    );
                    general_reservation::where('id', $id)->update($general_reservation_arr);
                    // Notification::send(null,new SendNotification($title,$message,$fcmTokens));
                    $response = [
                        'success' => true,
                        'message' => "General Reservation Request Cancellation Rejected!",
                    ];

                }



                $adminfeedback="";


                if($status=="Rejected"){

                        if($request->feedback){
                            $adminfeedback=" Admin Feedback: ".$request->feedback;

                        }

                }


                $is_feedback_on=false;
                if($status=="Approved"){

                    $is_feedback_on=true;

                }


                    $manual = 0;  // because the push notification is being sent by system
                    $receiver_id =array($general_reservation->users_id);
                    // dd($receiver_id);
                    $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                    $receivers_token = array_column($receivers, 'fcm_token');
                    $fcm_token = $receivers_token;


                    $sender_id = $usersaveddata[0]->id;

                    $title = "General Reservation Request has been ". $status ;
                    $body = "Admin has ". $status ." your General Reservation request.". $adminfeedback;
                    if(count($fcm_token) > 0)
                    {
                         sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,$is_feedback_on);

                    $code = 200;
                    return response()->json($response, $code);


            }else{
                $error = 'This user must have rights of Super admin to perform this operation Or owner didnt apply for cancellation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }

        }else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function getAllGeneralReservationCancellations(Request $request)
    {
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
                $general_reservation = general_reservation::with(['user' => function($q){$q->select('id','first_name','last_name','email');}])->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->get();
                $response = [
                    'success' => true,
                    'data' => $general_reservation,
                ];
                $code = 200;
                return response()->json($response, $code);
            }else{
                $error = 'This user must have rights of Super admin to perform this operation';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
            }
        }
        else
        {
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }
}
