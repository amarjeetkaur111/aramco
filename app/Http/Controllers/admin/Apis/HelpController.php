<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use App\Models\Apis\User;
use App\Models\Apis\help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HelpController extends Controller
{
    //


    public function SendHelpRequest(Request $request){


        $title = $request->title;

        $comment =  $request->comment;
        $google_id = $request->google_id;
        $userdata = User::where('google_id',$google_id)->select('id','email')->get();


        $users_id = $userdata[0]->id;
        $email =  $userdata[0]->email;
        $file_path="";

        if ($request->has('attachment')) {

            if (env('STORAGE') == "local") {
                $file = $request->attachment;
                $filename = str_replace('.', '-', $request->title) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->attachment->getClientOriginalExtension();
                $fileup = $file->storeAs('helpAttachments', $filename, ['disk' => 'my_files']);
                $file_path = env('ASSET_URL') . '/uploads/helpAttachments/' . $filename;
            }

            if (env('STORAGE') == "s3") {

                $filee = $request->attachment;
                $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $request->attachment, "helpAttachments/" . $filename, 'public');
                $file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }
        }

        $help = new help;
        $help->title = $title ;
        $help->comment = $comment;
        $help->users_id = $users_id;
        $help->document_path = $file_path;
        $help->save();


        $manual = 0;  // because the push notification is being sent by system
        $receiver_id =getAdminIds('id');
        $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
        $receivers_token = array_column($receivers, 'fcm_token');
        $fcm_token = $receivers_token;


        $sender_id = $users_id;

        $title = "Help request";
        $body = "User has requested for help";
        if(count($fcm_token) > 0)
        {
            $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        }
        saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

        $response = [
            'success' => true,
            'data' => 'Help request has been sent successfully',
        ];

            $code = 200;
            return response()->json($response, $code);



    }

    public function getallHelpRequests(Request $request){


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


                $help = help::select('help.id as helpid','users.google_id as google_id', 'users.first_name as first_name',  'users.last_name as last_name','users.email as email', 'help.title', 'help.comment','help.document_path', 'help.status','help.admin_comment', 'help.created_at')
                ->join('users', 'help.users_id', '=', 'users.id')
                ->get();

                $response = [
                    'success' => true,
                    'data' => $help,
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



    public function getallHelpRequestsUser(Request $request){


        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();
        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;



                $help = help::select('help.id as helpid','users.google_id as google_id', 'users.first_name as first_name',  'users.last_name as last_name','users.email as email', 'help.title', 'help.comment','help.document_path', 'help.status','help.admin_comment', 'help.created_at')
                ->join('users', 'help.users_id', '=', 'users.id')->where('help.users_id',$userid)
                ->get();

                $response = [
                    'success' => true,
                    'data' => $help,
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





    public function RespondHelpRequest(Request $request){

// dd($request->all());


        $helpid = $request->helpid;

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
              $help_rec = help::where('id',$helpid)->get();
                // dd($help_rec);

              $receiver_id= $help_rec[0]->users_id;
            //   dd($receiver_id);

                $feedarray = array(
                    'admin_comment' => $comment,
                    'status' => 'Replied',
                );
                $affectedRows = help::where('id', $helpid)->update($feedarray);






                $receivers = User::where('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
// dd($receivers);

                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $userid;

                $title = "You receieved a comment on your help request";
                $body = $comment;
                if(count($fcm_token) > 0)
                {
                    $result = sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);

                }
        saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id);


                $response = [
                    'success' => true,
                    'data' => 'Comment has been posted on users help request successfully',
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


}
