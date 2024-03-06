<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\User;
use Spatie\Permission\Models\Role;

use App\Models\Apis\questionaire;
use App\Models\Apis\questionaire_answers;
use App\Models\Apis\profile_completion_requests;
use Illuminate\Support\Facades\Storage;
use App\Models\Apis\controlsystem;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Apis\notification;
use App\Models\Apis\notification_detail;
use App\Models\Apis\feedback;

class UserController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    private function sendErrorResponse($error)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        $code = 404;
        return response()->json($response, $code);
    }

    public function getprofilerequests($google_id)
    {

    }

    public function createUser(Request $request)
    {
        // dd("hello");
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) == 0) {
            $file_path = "";
            if ($request->has('profile_photo')) {
                $file_path = "";
                if (env('STORAGE') == "local") {
                    $file = $request->profile_photo;
                    $filename = str_replace('.', '-', $request->email) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->profile_photo->getClientOriginalExtension();
                    $fileup = $file->storeAs('profilephotos', $filename, ['disk' => 'my_files']);
                    $file_path = env('ASSET_URL') . '/uploads/profilephotos/' . $filename;

                }

                if (env('STORAGE') == "s3") {
                    $filee = $request->profile_photo;
                    $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                    $path = Storage::disk('s3')->putFileAs('', $request->profile_photo, "profilephotos/" . $filename, 'public');
                    $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                }
            }
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->google_id = $request->google_id;
            $user->google_secret_key = $request->google_secret_key;
            $user->factor_secret_key = $request->factor_secret_key;
            $user->facial_analysis_photo = $request->facial_analysis_photo;
            // $user->profile_photo = $request->profile_photo;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->nationality = $request->nationality;
            $user->job_experience = $request->job_experience;
            $user->phone = $request->phone;
            $user->twitter_account = $request->twitter_account;
            $user->linkedin_account = $request->linkedin_account;
            // $file_path="oooo";
            $user->profile_photo = $file_path;
            $user->storage_type = env('STORAGE');
            // $user->slug = $this->createSlug();
            $user->save();
            $user->assignRole(3);
            $userid = $user->id;



            $controldata = new controlsystem;
            $controldata->users_id= $userid;
            $controldata->schedule_request= 0;
            $controldata->robin_event_request= 0;
            $controldata->incubator_request= 0;
            $controldata->computing_resource_request= 0;
            $controldata->technology_workshop_request= 0;
            $controldata->idea_request= 0;
            $controldata->general_reservation_request= 0;
            $controldata->calendar= 0;
            $controldata->help= 0;
            $controldata->connect= 0;
            $controldata->ar= 0;
            $controldata->save();

        } else {
            $userid = $usersaveddata[0]->id;
        }
        $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
        $userroles_ = str_replace(" ", "_", $userroles);
        $userdata = array();
        $usersaveddata = User::where('id', $userid)->get();
        $userdata['first_name'] = $usersaveddata[0]->first_name;
        $userdata['last_name'] = $usersaveddata[0]->last_name;
        $userdata['email'] = $usersaveddata[0]->email;
        $userdata['dob'] = $usersaveddata[0]->dob;
        $userdata['gender'] = $usersaveddata[0]->gender;
        $userdata['nationality'] = $usersaveddata[0]->nationality;
        $userdata['job_experience'] = $usersaveddata[0]->job_experience;
        $userdata['profile_photo'] = $usersaveddata[0]->profile_photo;
        $userdata['phone'] = $usersaveddata[0]->phone;
        $userdata['role'] = $userroles_;
        $userdata['google_id'] = $usersaveddata[0]->google_id;
        $userdata['google_secret_key'] = $usersaveddata[0]->google_secret_key;
        $userdata['factor_secret_key'] = $usersaveddata[0]->factor_secret_key;
        $userdata['facial_analysis_photo'] = $usersaveddata[0]->facial_analysis_photo;
        $userdata['twitter_account'] = $usersaveddata[0]->twitter_account;
        $userdata['linkedin_account'] = $usersaveddata[0]->linkedin_account;
        $profilesaveddata = profile_completion_requests::select('id as profile_request_id', 'first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'nationality', 'job_experience', 'status', 'created_at')->orderBy('created_at', 'asc')->where('users_id', $userid)->get();
        $userdata['profile_completion_requests'] = $profilesaveddata;
        // $userdata['photo_path'] = $this->downloadurl.$usersaveddata[0]->slug;
        // $userdata['updated_at'] = $usersaveddata[0]->created_at;
        // $userdata['created_at'] = $usersaveddata[0]->created_at;
        // $userdata['id'] = $usersaveddata[0]->id;
        // $userdata['stadium'] = $usersaveddata[0]->stadium;
        $response = [
            'success' => true,
            'data' => $userdata,
            'message' => "User created successfully",
        ];
        return response()->json($response, 200);
    }

    public function profileCompletitionRequest(Request $request)
    {

        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        // print_r($usersaveddata);
        $userid = $usersaveddata[0]->id;
        if (count($usersaveddata) > 0) {
            // dd($request->all());
            $user = new profile_completion_requests;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->users_id = $userid;
            $user->facial_analysis_photo = $request->facial_analysis_photo;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->nationality = $request->nationality;
            $user->job_experience = $request->job_experience;
            $user->phone = $request->phone;
            $user->save();
            $profilid = $user->id;
            $profilesaveddata = profile_completion_requests::select('id as profile_request_id', 'first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'nationality', 'job_experience', 'status', 'created_at')->orderBy('created_at', 'asc')->where('id', $profilid)->get();


            $manual = 0;  // because the push notification is being sent by system
            $receiver_id =getAdminIds('id');
            $sender = $user->id;

            $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
            $receivers_token = array_column($receivers, 'fcm_token');
            $fcm_token = $receivers_token;


            $sender_id = $user->id;

            $title = "Profile completion Request";
            $body = "user has requested profile completion";
            if(count($fcm_token) > 0)
            {
                $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }

            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            $response = [
                'success' => true,
                'data' => $profilesaveddata,
                'message' => "Profile completion request has been submitted successfully.",
            ];

        } else {
            $response = [
                'success' => true,
                'data' => '',
                'message' => "Profile completion request was not submitted successfully.",
            ];
        }
        return response()->json($response, 200);
    }

    public function updatetwofactor(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userarray = array(
                'factor_secret_key' => $request->factor_secret_key,
            );
            $affectedRows = User::where('id', $userid)->update($userarray);
            return $this->sendResponse([], 'Two factor has been updated successfully.');
        } else {

            $this->sendError('No user found');
        }
    }

    public function updateUserProfile(Request $request)
    {
        // dd("hello");
        $google_id = $request->google_id;
        // dd($google_id);
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            if ($request->has('profile_photo')) {
                $file_path = "";
                if (env('STORAGE') == "local") {
                    $file = $request->profile_photo;
                    $filename = str_replace('.', '-', $request->email) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->profile_photo->getClientOriginalExtension();
                    $fileup = $file->storeAs('profilephotos', $filename, ['disk' => 'my_files']);
                    $file_path = env('ASSET_URL') . '/uploads/profilephotos/' . $filename;
                }

                if (env('STORAGE') == "s3") {
                    $filee = $request->profile_photo;
                    $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                    $path = Storage::disk('s3')->putFileAs('', $request->profile_photo, "profilephotos/" . $filename, 'public');
                    $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                }

                $userphotoarray = array(
                    'profile_photo' => $file_path,
                );
                $affectedRows = User::where('id', $userid)->update($userphotoarray);
            }

            $userarray = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'facial_analysis_photo' => $request->facial_analysis_photo,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'job_experience' => $request->job_experience,
                'phone' => $request->phone,
                'twitter_account' => $request->twitter_account,
                'linkedin_account' => $request->linkedin_account,
            );
            $affectedRows = User::where('id', $userid)->update($userarray);
            //  dd($usersaveddata);
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $userdata = array();
            $usersaveddata = User::where('id', $userid)->get();
            $userdata['first_name'] = $usersaveddata[0]->first_name;
            $userdata['last_name'] = $usersaveddata[0]->last_name;
            $userdata['email'] = $usersaveddata[0]->email;
            $userdata['dob'] = $usersaveddata[0]->dob;
            $userdata['gender'] = $usersaveddata[0]->gender;
            $userdata['nationality'] = $usersaveddata[0]->nationality;
            $userdata['job_experience'] = $usersaveddata[0]->job_experience;
            $userdata['profile_photo'] = $usersaveddata[0]->profile_photo;
            $userdata['storage_type'] = env('STORAGE');
            $userdata['phone'] = $usersaveddata[0]->phone;
            $userdata['role'] = $userroles_;
            $userdata['google_id'] = $usersaveddata[0]->google_id;
            $userdata['google_secret_key'] = $usersaveddata[0]->google_secret_key;
            $userdata['factor_secret_key'] = $usersaveddata[0]->factor_secret_key;
            $userdata['facial_analysis_photo'] = $usersaveddata[0]->facial_analysis_photo;
            $userdata['twitter_account'] = $usersaveddata[0]->twitter_account;
            $userdata['linkedin_account'] = $usersaveddata[0]->linkedin_account;
            $profilesaveddata = profile_completion_requests::select('id as profile_request_id', 'first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'nationality', 'job_experience', 'status', 'created_at')->orderBy('created_at', 'asc')->where('users_id', $userid)->get();
            $userdata['profile_completion_requests'] = $profilesaveddata;
            // $userdata['photo_path'] = $this->downloadurl.$usersaveddata[0]->slug;
            // $userdata['updated_at'] = $usersaveddata[0]->created_at;
            // $userdata['created_at'] = $usersaveddata[0]->created_at;
            // $userdata['id'] = $usersaveddata[0]->id;
            // $userdata['stadium'] = $usersaveddata[0]->stadium;
            $response = [
                'success' => true,
                'data' => $userdata,
                'message' => "User profile has been updated successfully",
            ];
            return response()->json($response, 200);
        }
    }

    public function deleteUserProfile(Request $request)
    {
        // dd("hello");
        $google_id = $request->google_id;
        // dd($google_id);
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $user = User::find($userid);
            $user->delete();
            $response = [
                'success' => true,
                'data' => '',
                'message' => "User profile has been deleted successfully",
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => true,
                'data' => '',
                'message' => "This user profile doesn't exists",
            ];
            return response()->json($response, 200);
        }
    }


    public function getAllUsers(Request $request)
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
                // if($userroles_=="Super_Admin" || $userroles_=="Admin"){
                // $users=  User::with('roles')->get();
                $users = User::get();
                $allusers = array();
                $userdata = array();
                foreach ($users as $usersaveddata) {
                    $userroles = implode(',', User::find($usersaveddata->id)->getRoleNames()->toArray());
                    $userroles_ = str_replace(" ", "_", $userroles);
                    $userdata['first_name'] = $usersaveddata->first_name;
                    $userdata['last_name'] = $usersaveddata->last_name;
                    $userdata['email'] = $usersaveddata->email;
                    $userdata['dob'] = $usersaveddata->dob;
                    $userdata['gender'] = $usersaveddata->gender;
                    $userdata['nationality'] = $usersaveddata->nationality;
                    $userdata['job_experience'] = $usersaveddata->job_experience;
                    $userdata['profile_photo'] = $usersaveddata->profile_photo;
                    $userdata['phone'] = $usersaveddata->phone;
                    $userdata['google_id'] = $usersaveddata->google_id;
                    $userdata['google_secret_key'] = $usersaveddata->google_secret_key;
                    $userdata['factor_secret_key'] = $usersaveddata->factor_secret_key;
                    $userdata['facial_analysis_photo'] = $usersaveddata->facial_analysis_photo;
                    $userdata['twitter_account'] = $usersaveddata->twitter_account;
                    $userdata['linkedin_account'] = $usersaveddata->linkedin_account;
                    $userdata['role'] = $userroles_;
                    $profilesaveddata = profile_completion_requests::select('id as profile_request_id', 'first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'nationality', 'job_experience', 'status', 'created_at')->orderBy('created_at', 'asc')->where('users_id', $usersaveddata->id)->get();
                    $userdata['profile_completion_requests'] = $profilesaveddata;
                    $allusers[] = $userdata;
                }
                $response = [
                    'success' => true,
                    'data' => $allusers,
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

    public function getAllUsersLimitedData(Request $request)
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
                // if($userroles_=="Super_Admin" || $userroles_=="Admin"){
                // $users=  User::with('roles')->get();
                $users = User::select('id','first_name', 'last_name', 'email','google_id')->get();
                $allusers = array();
                $userdata = array();
                foreach ($users as $usersaveddata) {
                    $userdata['user_id'] = $usersaveddata->id;
                    $userdata['first_name'] = $usersaveddata->first_name;
                    $userdata['last_name'] = $usersaveddata->last_name;
                    $userdata['email'] = $usersaveddata->email;
                    $userdata['google_id'] = $usersaveddata->google_id;
                    $allusers[] = $userdata;
                }
                $response = [
                    'success' => true,
                    'data' => $allusers,
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

    public function getAllRoles()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        $roles_arr = array();
        $roledata = array();
        foreach ($roles as $role) {
            $roledata['id'] = $role->id;
            // $roledata['role'] = trim(str_replace(" ", "_", $role->name));
            $roledata['role'] = trim(str_replace(" ", "_", $role->name));
            // $roledata['lenghth'] = strlen(trim(str_replace(" ", "_", $role->name)));
            $roles_arr[] = $roledata;
        }
        $response = [
            'success' => true,
            'data' => $roles_arr,
        ];
        return response()->json($response, 200);
    }

    public function changeRole(Request $request)
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
                $user_google_id = $request->user_google_id;
                $role_name = str_replace("_", " ", $request->role);
                $userdata = User::where('google_id', $user_google_id)->first();
                $userdata->roles()->detach();
                $userdata->assignRole($role_name);
                $response = [
                    'success' => true,
                    'data' => '',
                    'message' => "Role has been changed successfully",
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


    public function GetProfileRequestStatus(Request $request)
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
                $profile_request_id = $request->profile_request_id;
                $status = $request->status;
            }
        }
    }


    public function ChangeProfileRequestStatus(Request $request)
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
                $profile_request_id = $request->profile_request_id;
                $status = $request->status;
                $profile_request_arr = array(
                    'status' => $status,
                );
                $affectedRows = profile_completion_requests::orderBy('created_at', 'asc')->where('id', $profile_request_id)->update($profile_request_arr);

                if ($status == "Approved") {
                    $profile_completition_saveddata = profile_completion_requests::orderBy('created_at', 'asc')->where('id', $profile_request_id)->get();

                    if (count($profile_completition_saveddata) == 0) {
                        $error = 'This user\'s profile is not complete yet.';
                        $response = [
                            'success' => false,
                            'message' => $error,
                        ];
                        $code = 404;
                        return response()->json($response, $code);
                    }
                    //dd($profile_request_id, $profile_completition_saveddata);
                    $userarray = array(
                        'first_name' => $profile_completition_saveddata[0]->first_name,
                        'last_name' => $profile_completition_saveddata[0]->last_name,
                        'email' => $profile_completition_saveddata[0]->email,
                        'facial_analysis_photo' => $profile_completition_saveddata[0]->facial_analysis_photo,
                        'dob' => $profile_completition_saveddata[0]->dob,
                        'gender' => $profile_completition_saveddata[0]->gender,
                        'nationality' => $profile_completition_saveddata[0]->nationality,
                        'job_experience' => $profile_completition_saveddata[0]->job_experience,
                        'phone' => $profile_completition_saveddata[0]->phone,
                        'status' => $profile_completition_saveddata[0]->status,
                    );
                    $affectedRows = User::find($profile_completition_saveddata[0]->users_id);
                    $affectedRows->update($userarray);
                    // $affectedRows = User::where('id', $profile_completition_saveddata[0]->users_id)->update($userarray);
                    $role = Role::where('id', 4)->first();
                    $affectedRows->syncRoles($role);







                    $usercontrol=array(

                        'schedule_request' => 1,
                        'robin_event_request' => 1,
                        'incubator_request' => 1,
                        'computing_resource_request' => 1,
                        'technology_workshop_request' =>1,
                        'idea_request' => 1,
                        'general_reservation_request' => 1,
                        'calendar' => 1,
                        'help' => 1,
                        'connect' => 1,
                        'ar' => 1,
                        );

                        controlsystem::where('users_id', $profile_completition_saveddata[0]->users_id)->update($usercontrol);


                }
                $response = [
                    'success' => true,
                    'data' => '',
                    'message' => "Profile Completion request status has been changed successfully",
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

    public function getAllProfilerequests(Request $request)
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
                // if($userroles_=="Super_Admin" || $userroles_=="Admin"){
                // $users=  User::with('roles')->get();
                $profilesaveddata = profile_completion_requests::select('id as profile_request_id', 'first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'nationality', 'job_experience', 'status', 'created_at')->orderBy('created_at', 'asc')->get();
                $response = [
                    'success' => true,
                    'data' => $profilesaveddata,
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


    public function getQuestionaire(Request $request)
    {
        $questionaire = questionaire::select('id as question_id', 'question')->get();
        if (count($questionaire) > 0) {
            $response = [
                'success' => true,
                'data' => $questionaire,
            ];
            $code = 200;
        } else {
            $error = 'Sorry! no question found';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
        }
        return response()->json($response, $code);
    }

    public function postAnswer(Request $request)
    {
        $user_google_id = $request->user_google_id;
        $question_ids = $request->question_ids;
        $answers = $request->answers;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        if (count($usersaveddata) > 0) {
            $usersavedanswers = questionaire_answers::where('google_id', $user_google_id)->where('users_id', $usersaveddata[0]->id)->get();
            if (count($usersavedanswers) > 0) {
                questionaire_answers::where('google_id', $user_google_id)->delete();
            }
            foreach ($question_ids as $key => $value) {
                $questionaire_answers = new questionaire_answers;
                $questionaire_answers->questionaire_id = $question_ids[$key];
                $questionaire_answers->answer = $answers[$key];
                $questionaire_answers->google_id = $user_google_id;
                $questionaire_answers->users_id = $usersaveddata[0]->id;
                $questionaire_answers->save();
            }
            $message = 'Answers has been posted successfully';
            $response = [
                'success' => true,
                'message' => $message,
            ];
            $code = 200;
        } else {
            $error = 'Sorry!No user found for this google id';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
        }
        return response()->json($response, $code);
    }


    public function getuserAnswers(Request $request)
    {
        $user_google_id = $request->user_google_id;
        $usersaveddata = User::where('google_id', $user_google_id)->get();
        if (count($usersaveddata) > 0) {
            $answers = questionaire::select('questionaire.id as question_id', 'questionaire.question', 'questionaire_answers.answer')
                ->join('questionaire_answers', 'questionaire_answers.questionaire_id', '=', 'questionaire.id')
                ->where('questionaire_answers.users_id', $usersaveddata[0]->id)
                ->get();
            // dd($answers);
            $message = 'Answers has been posted successfully';
            $response = [
                'success' => true,
                'data' => $answers,
            ];
            $code = 200;
        } else {
            $error = 'Sorry!No user found for this google id';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
        }
        return response()->json($response, $code);
    }

    public function updateToken(Request $request)
    {
        try{
        $request->user()->update(['fcm_token' => $request->token]);
        return response()->json([
            'success' => true
        ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }

    public function updateTokenAPI(Request $request)
    {
        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            User::where('google_id', $google_id)->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true,
                'message' => 'Token Updated Successfully!'
            ]);
        }
        else{
            $error = 'Unauthorize user request or this id does not exist';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }
    }

    public function notificationAPI(Request $request)
    {
        $manual =  $request->manual;
        $receiver_id = $request->receiver_id;
        $sender = $request->sender_id;

        $receivers = User::whereIn('google_id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;

        $receiver_id = array_column($receivers, 'id');

        $sender = User::where('google_id',$sender)->select('id')->get();
        $sender_id = $sender[0]->id;

        $title = $request->title;
        $body = $request->body;

        // saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);
        if(count($fcm_token) > 0)
        {
            $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);
            if($result == true)
                return response()->json([
                    'success' => true,
                    'message' => 'Notification Sent Successfully!'
                ]);
            else
                return response()->json([
                    'success' => false,
                    'notification' => $result,
                    'message' => 'Something Went Wrong!'
                ]);

        }
        else
        {
            $error = 'Atleast One FCM Token is required.';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
        }

    }

    public function getSenderNotifications(Request $request)
    {
        $google_id = $request->google_id;
        $manual =  $request->manual;
        $google_id = User::where('google_id',$google_id)->select('id')->get();
        $id = $google_id[0]->id;
        $data = notification::with('receiver')->where('sender_id',$id)->where('manual',$manual)->get();
        $response = [
            'success' => true,
            'data' => $data,
        ];
        $code = 200;
        return response()->json($response, $code);
    }

    public function getReceiverNotifications(Request $request)
    {
        $google_id = $request->google_id;
        $google_id = User::where('google_id',$google_id)->select('id')->get();
        $id = $google_id[0]->id;
        $data = notification_detail::with('sender')->where('receiver_id',$id)->orderBy('created_at','asc')->get();
        // dd($data->toArray());
        $response = [
            'success' => true,
            'data' => $data,
        ];
        $code = 200;
        return response()->json($response, $code);
    }

    public function setNotificationOnOff(Request $request)
    {
        $google_id = $request->google_id;
        $manual = $request->manual;
        $google_id = User::where('google_id',$google_id)->select('id')->get();
        $id = $google_id[0]->id;
        if(notification::where('sender_id',$id)->update(['manual' => $manual]))
            $response = [
                'success' => true,
                'data' => 'Updated Manual Successfully',
            ];
        else
            $response = [
                'success' => false,
                'data' => 'Something Went Wrong!',
            ];
        $code = 200;
        return response()->json($response, $code);
    }

    public function getNotificationOnOff(Request $request)
    {
        $google_id = $request->google_id;
        $google_id = User::where('google_id',$google_id)->select('id')->get();
        $id = $google_id[0]->id;
        $data = notification::where('sender_id',$id)->get();
        $response = [
            'success' => true,
            'data' => $data[0]->manual ? 'On' : 'Off',
        ];

        $code = 200;
        return response()->json($response, $code);
    }


    public function sendPushNotificationUsers(){


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
                $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

            }
        // saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        }
    }


    public function Sendfeedback(Request $request){


        $title = $request->title;

        $comment =  $request->comment;
        $google_id = $request->google_id;
        $userdata = User::where('google_id',$google_id)->select('id','email')->get();


        $users_id = $userdata[0]->id;
        $email =  $userdata[0]->email;

        $feedback = new feedback;
        $feedback->title = $title ;
        $feedback->comment = $comment;
        $feedback->users_id = $users_id;
        $feedback->save();


        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;


        $sender_id = $users_id;

        $title = "Feedback";
        $body = "User has sent a feedback";
        if(count($fcm_token) > 0)
        {
            $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        }

        saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        $response = [
            'success' => true,
            'data' => 'Feedback has been sent successfully',
        ];

            $code = 200;
            return response()->json($response, $code);



    }

    public function getallFeedbacks(Request $request){


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


                $feedback = feedback::select('feedback.id as feedbackid','users.google_id as google_id', 'users.first_name as first_name',  'users.last_name as last_name','users.email as email', 'feedback.title', 'feedback.comment', 'feedback.status','feedback.admin_comment', 'feedback.created_at')
                ->join('users', 'feedback.users_id', '=', 'users.id')
                ->get();

                $response = [
                    'success' => true,
                    'data' => $feedback,
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





    public function Respondfeedback(Request $request){




        $feedbackid = $request->feedbackid;

        $comment =  $request->comment;
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


                $manual=0;
              $feedback_rec = feedback::where('id',$feedbackid)->get();
              $receiver_id= $feedback_rec[0]->users_id;


                $feedarray = array(
                    'admin_comment' => $comment,
                    'status' => 'Replied',
                );
                $affectedRows = feedback::where('id', $feedbackid)->update($feedarray);






                $receivers = User::where('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();


                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $userid;

                $title = "You receieved a comment on your feedback";
                $body = $comment;
                if(count($fcm_token) > 0)
                {
                    $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
                saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                $response = [
                    'success' => true,
                    'data' => 'Comment has been posted on users feedback successfully',
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


    public function FeedbackOnFlag(Request $request){


        $is_feedback_on =  $request->is_feedback_on;
        $google_id = $request->google_id;
        $notification_id = $request->notification_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {

            // if($request->is_feedback_on==true){


            //     $is_feedback_on=1;

            // }
            // if($request->is_feedback_on==false){


            //     $is_feedback_on=0;

            // }


          $notifarr=array(

            "is_feedback_on" => $is_feedback_on

          );

          notification::where('id', $notification_id)->update($notifarr);

          $response = [
            'success' => true,
            'data' => 'Feedback On flag has been set Successfully',
        ];
        return response()->json($response, 200);



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


}
