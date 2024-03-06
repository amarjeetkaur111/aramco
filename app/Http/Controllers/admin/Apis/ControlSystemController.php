<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Apis\controlsystem;
use App\Models\Apis\User;



class ControlSystemController extends Controller
{
    //

    public function getUsersControl(Request $request){
        

        $admin_google_ids =getAdminIds('google_id');

         if(!empty($request->google_id)){
            

          //these google ids will always be in array, no matter single user or multiple all google ids will be sent here in array


            // $diff_1=array_diff($request->google_id,$admin_google_ids);  //excluding admin google ids so admin cannot change teh controls for otehr admins, this is only non admin users control list

            //  $user_google_id = $diff_1;


             $user_google_id = $request->google_id;
            //  dd($user_google_id);


            $usersids= User::select('id')->whereIn('google_id', $user_google_id)->get()->toArray();
            
            
            $controlsystem = controlsystem::select('users.google_id','schedule_request','robin_event_request','incubator_request','computing_resource_request','technology_workshop_request','idea_request','general_reservation_request','calendar','help','connect','ar','roles.name as role')->whereIn('users_id', $usersids)
            ->join('users', 'users_control_system.users_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get()->toArray();

         }else{

            $controlsystem = controlsystem::select('users.google_id','schedule_request','robin_event_request','incubator_request','computing_resource_request','technology_workshop_request','idea_request','general_reservation_request','calendar','help','connect','ar','roles.name as role')
           ->whereNotIn('users.google_id', $admin_google_ids)
            ->join('users', 'users_control_system.users_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get()->toArray();

         }



        $response = [
            'success' => true,
            'data' => $controlsystem,

        ];
        return response()->json($response, 200);
    }



    public function ModifyUsersControl(Request $request){

// dd($request->all());

        $admin_google_id = $request->admin_google_id;
        $usersaveddata = User::where('google_id', $admin_google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {

                    $user_google_id = $request->google_id; //these google ids will always be in array, no matter single user or multiple all google ids will be sent here in array
                    // dd($user_google_id);
                    $usersids= User::select('id')->whereIn('google_id', $user_google_id)->get()->toArray();

                    // dd($request->all());


                        foreach($usersids as $key=> $value){

                            $controldata = array(
                                'schedule_request' => $request->schedule_request[$key],
                                'robin_event_request' => $request->robin_event_request[$key],
                                'incubator_request' => $request->incubator_request[$key],
                                'computing_resource_request' => $request->computing_resource_request[$key],
                                'technology_workshop_request' => $request->technology_workshop_request[$key],
                                'idea_request' => $request->idea_request[$key],
                                'general_reservation_request' => $request->general_reservation_request[$key],
                                'calendar' => $request->calendar[$key],
                                'help' => $request->help[$key],
                                'connect' => $request->connect[$key],
                                'ar' => $request->ar[$key],
                            );
                            
                            controlsystem::where('users_id',$value)->update($controldata);

                        }
                        // echo "<pre>";print_r($request->help[$key]);exit;
                        // echo "<pre>";print_r($request->schedule_request[$key]);
                        // echo "<pre>";print_r($request->robin_event_request[$key]);
                        // echo "<pre>";print_r($request->incubator_request[$key]);
                        // echo "<pre>";print_r($request->computing_resource_request[$key]);
                        // echo "<pre>";print_r($request->technology_workshop_request[$key]);
                        // echo "<pre>";print_r($request->idea_request[$key]);
                        // echo "<pre>";print_r($request->general_reservation_request[$key]);
                        // echo "<pre>";print_r($request->calendar[$key]);
                        // echo "<pre>";print_r($request->help[$key]);
                        // echo "<pre>";print_r($request->connect[$key]);
                        // echo "<pre>";print_r($request->ar[$key]);exit;
                        // dd('updated');


                        $response = [
                            'success' => true,
                            'message' => "users Control has been modified successfully",
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
            $error = 'Unauthorize user request or this admin does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }





    }




    public function ModifyUsersControlAll(Request $request){
// dd($request->all());


        $admin_google_id = $request->admin_google_id;
        $usersaveddata = User::where('google_id', $admin_google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            if (count($result) > 0) {

                    // $user_google_id = $request->google_id; //these google ids will always be in array, no matter single user or multiple all google ids will be sent here in array
                    // $usersids= User::select('id')->whereIn('google_id', $user_google_id)->get()->toArray();


                    $usersids=getNonAdminIds('Full Access User','id');

                    // dd($usersids);


                        foreach($usersids as $key=> $value){

                            $controldata = array(
                                'schedule_request' => $request->schedule_request,
                                'robin_event_request' => $request->robin_event_request,
                                'incubator_request' => $request->incubator_request,
                                'computing_resource_request' => $request->computing_resource_request,
                                'technology_workshop_request' => $request->technology_workshop_request,
                                'idea_request' => $request->idea_request,
                                'general_reservation_request' => $request->general_reservation_request,
                                'calendar' => $request->calendar,
                                'help' => $request->help,
                                'connect' => $request->connect,
                                'ar' => $request->ar,
                            );
                            controlsystem::where('users_id',$value)->update($controldata);

                        }


                        $response = [
                            'success' => true,
                            'message' => "All users Control has been modified successfully",
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
            $error = 'Unauthorize user request or this admin does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }





    }
}
