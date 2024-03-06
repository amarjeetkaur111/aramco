<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\User;
use App\Models\Apis\channels;
use App\Models\Apis\channels_posts;
use App\Models\Apis\channels_posts_comments;
use App\Models\Apis\channels_posts_likes;
use DB;
use Illuminate\Support\Facades\Storage;


class ConnectSystemController extends Controller
{
    //

    public function CreateChannel(Request $request){




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



                $file_path = "";

                if ($request->has('icon')) {

                    if (env('STORAGE') == "local") {
                        $file = $request->icon;
                        $filename = str_replace(' ','_',strtolower($request->title)) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->icon->getClientOriginalExtension();
                        $fileup = $file->storeAs('channelsicons', $filename, ['disk' => 'my_files']);
                        $file_path = env('ASSET_URL') . '/uploads/channelsicons/' . $filename;

                    }

                    if (env('STORAGE') == "s3") {
                        $filee = $request->icon;
                        $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                        $path = Storage::disk('s3')->putFileAs('', $request->icon, "channelsicons/" . $filename, 'public');
                        $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                    }
                }else{

                    $file_path = env('ASSET_URL') . '/uploads/defaultimages/channel.png';

                }


                $channels = new channels;
                $channels->title = $request->title;
                $channels->description =$request->description;
                $channels->icon = $file_path;
                $channels->storage_type = env('STORAGE');
                $channels->created_by = $userid;
                $channels->status = "Active";
                $channels->save();


                $response = [
                    'success' => true,
                    'message' => "Channel has been created successfully",
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


       public function GetAllChannels(){

         $channels=channels::Select('id','title','icon','description','status','created_at')
         ->withCount('channels_posts')
        ->get()->toArray();

        if(count($channels)>0){


            $response = [
                'success' => true,
                'data' => $channels,
            ];
            $code = 200;
        }else{

            $error = 'Sorry! No channel exists.';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;


        }



        return response()->json($response, 200);


       }


       public function DeleteChannel(Request $request){

        $channel_id=$request->channel_id;

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

                        channels::where('id', $channel_id)->delete();


                        $posts=channels_posts::where('channels_id', $channel_id)->get();

                        foreach($posts as $post){

                               channels_posts_comments::where('channels_posts_id', $post->id)->delete();
                        }

                        channels_posts::where('channels_id', $channel_id)->delete();




                    $response = [
                        'success' => true,
                        'message' => "The Channel has been deleted successfully",
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





      public function BlockChannel(Request $request){

        $channel_id=$request->channel_id;

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


                        $channeldata = array(
                            'status' => 'Blocked',
                        );
                        channels::where('id', $channel_id)->update($channeldata);

                    $response = [
                        'success' => true,
                        'message' => "The Channel has been blocked successfully",
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





      public function UnBlockChannel(Request $request){

        $channel_id=$request->channel_id;

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


                        $channeldata = array(
                            'status' => 'Active',
                        );
                        channels::where('id', $channel_id)->update($channeldata);

                    $response = [
                        'success' => true,
                        'message' => "The Channel has been unblocked successfully",
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


      public function GetChannelsAllPosts(Request $request){


        $channel_id=$request->channel_id;




        $posts =channels_posts::select('channels_posts.id','channels_posts.post_text','channels_posts.post_image','users.google_id as authors_google_id','users.first_name', 'users.last_name','users.profile_photo as authors_profile_photo','channels_posts.created_at')
        ->withCount('channels_posts_likes as post_likes')
        ->withCount('channels_posts_comments as comments_count')
		->join('users', 'channels_posts.users_id', '=', 'users.id')
        ->where('channels_id', $channel_id)
        ->where('channels_posts.status', "Active")
        ->get()->toArray();





        if(count($posts)>0){






        foreach($posts as $post){




            $posts_likes =channels_posts_likes::select('channels_posts_likes.users_id','users.google_id')
            ->join('users', 'channels_posts_likes.users_id', '=', 'users.id')
            ->where('channels_posts_likes.channels_posts_id', $post['id'])
            ->get();

                 $likers="";
                foreach($posts_likes as $like_users){


                    $likers.=$like_users->google_id.',';

                }





                // dd( $calendar_events_reg);

                $finalpostarr[]= array(
                    "id" => $post['id'],
                    "post_text" => $post['post_text'],
                    "post_image" => $post['post_image'],
                    "authors_google_id" => $post['authors_google_id'],
                    "author" => trim($post['first_name'].' '.$post['last_name']),
                    "authors_profile_photo" => $post['authors_profile_photo'],
                    "created_at" =>$post['created_at'],
                    "post_days_passed" => getTimePassed($post['created_at'],date("Y-m-d H:i:s"))['days'],
                    "post_likes" =>  $post['post_likes'],
                    "comments_count" =>  $post['comments_count'],
                    "post_likers" =>   rtrim($likers, ','),
                 );

                }



                $response = [
                    'success' => true,
                    'data' => $finalpostarr,
                ];

                $code = 200;


    }else{

                $error = 'Sorry! No posts found against this channel.';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;


    }


       return response()->json($response, $code);


      }



      public function GetPostsAllComments(Request $request){


        $channels_posts_id=$request->channels_posts_id;

        $posts =channels_posts_comments::select('channels_posts_comments.id','channels_posts_comments.comment_text','users.google_id as authors_google_id','users.first_name', 'users.last_name','users.profile_photo as authors_profile_photo','channels_posts_comments.created_at')
       	->join('users', 'channels_posts_comments.users_id', '=', 'users.id')
        ->where('channels_posts_id', $channels_posts_id)
        ->where('channels_posts_comments.status', "Active")
        ->get()->toArray();



        if(count($posts)>0){



                    foreach($posts as $post){





                        // dd( $calendar_events_reg);

                        $finalpostarr[]= array(
                            "id" => $post['id'],
                            "comment_text" => $post['comment_text'],
                            "authors_google_id" => $post['authors_google_id'],
                            "author" => trim($post['first_name'].' '.$post['last_name']),
                            "authors_profile_photo" => $post['authors_profile_photo'],
                            "created_at" =>$post['created_at'],
                            "comment_days_passed" => getTimePassed($post['created_at'],date("Y-m-d H:i:s"))['days'],

                        );

                        }




                $response = [
                    'success' => true,
                    'data' => $finalpostarr,
                ];

                $code = 200;


             }else{

                 $error = 'Sorry! No Comments found against this Post.';
                 $response = [
                     'success' => false,
                     'message' => $error,
                 ];
                 $code = 404;


             }


                return response()->json($response, $code);



      }


      public function GetUsersPosts(Request $request){



        $google_id = $request->google_id;
        $userdata = User::where('google_id', $google_id)->get();

        if(count($userdata)>0){
        $userid = $userdata[0]->id;




        $posts =channels_posts::select('channels_posts.id','channels_posts.post_text','channels_posts.post_image','users.google_id as authors_google_id','users.first_name', 'users.last_name','users.profile_photo as authors_profile_photo','channels_posts.created_at','channels.id as channel_id','channels.title as channel_title')
        ->withCount('channels_posts_likes as post_likes')
        ->withCount('channels_posts_comments as comments_count')
        ->join('channels', 'channels_posts.channels_id', '=', 'channels.id')
		->join('users', 'channels_posts.users_id', '=', 'users.id')
        ->where('channels_posts.users_id', $userid)
        ->get()->toArray();


                    if(count($posts)>0){

                        $finalpostarr=array();
                        foreach($posts as $post){


                            $posts_likes =channels_posts_likes::select('channels_posts_likes.users_id','users.google_id')
                            ->join('users', 'channels_posts_likes.users_id', '=', 'users.id')
                            ->where('channels_posts_likes.channels_posts_id', $post['id'])
                            ->get();

                                 $likers="";
                                foreach($posts_likes as $like_users){


                                    $likers.=$like_users->google_id.',';

                                }







                                // dd( $calendar_events_reg);

                                $finalpostarr[]= array(
                                    "id" => $post['id'],
                                    "post_text" => $post['post_text'],
                                    "post_image" => $post['post_image'],
                                    "authors_google_id" => $post['authors_google_id'],
                                    "author" => trim($post['first_name'].' '.$post['last_name']),
                                    "authors_profile_photo" => $post['authors_profile_photo'],
                                    "created_at" =>$post['created_at'],
                                    "post_days_passed" => getTimePassed($post['created_at'],date("Y-m-d H:i:s"))['days'],
                                    "post_likes" =>  $post['post_likes'],
                                    "comments_count" =>  $post['comments_count'],
                                    "post_likers" =>   rtrim($likers, ','),


                                 );

                        }






                $response = [
                    'success' => true,
                    'data' => $finalpostarr,
                ];


                $code = 200;


                }else{

                    $error = 'Sorry! No Posts found for this user.';
                    $response = [
                        'success' => false,
                        'message' => $error,
                    ];
                    $code = 404;


                }

            }else{

                $error = 'Sorry! This user does not exists.';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;


            }
       return response()->json($response, 200);


      }




      public function CreatePost(Request $request){




        $google_id = $request->google_id;
        $channel_id = $request->channel_id;
        $userdata = User::where('google_id', $google_id)->get();
        $userid=$userdata[0]->id;





                $file_path = "";

                if ($request->has('post_image')) {

                    if (env('STORAGE') == "local") {
                        $file = $request->post_image;
                        $filename = str_replace(' ','_',strtolower($request->channel_id)) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->post_image->getClientOriginalExtension();
                        $fileup = $file->storeAs('postsimages', $filename, ['disk' => 'my_files']);
                        $file_path = env('ASSET_URL') . '/uploads/postsimages/' . $filename;

                    }

                    if (env('STORAGE') == "s3") {
                        $filee = $request->post_image;
                        $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                        $path = Storage::disk('s3')->putFileAs('', $request->post_image, "postsimages/" . $filename, 'public');
                        $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                    }
                }


                $channels = new channels_posts;
                $channels->channels_id = $request->channel_id;
                $channels->users_id = $userid;
                $channels->post_text = $request->post_text;
                $channels->post_image = $file_path;
                $channels->storage_type = env('STORAGE');
                $channels->status = "Active";
                $channels->save();


                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =getAdminIds('id');




                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;




                $sender_id = $userid;

                $channel=channels::where('id', $channel_id)->get();

                $title = "New Post Created";
                $body =    $userdata[0]->first_name." ". $userdata[0]->last_name. " has created a Post on Channel ".$channel[0]->title;
                if(count($fcm_token) > 0)
                {
                     sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

                }

                saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

                $response = [
                    'success' => true,
                    'message' => "Post has been created successfully",
                ];
                return response()->json($response, 200);




       }




      public function CreateLikeOnPostOld(Request $request)
      {
        $google_id = $request->google_id;
        $post_id = $request->post_id;
        $postdata = channels_posts::where('id',  $post_id)->get();
        $userdata = User::where('google_id', $google_id)->get();
        $userid=$userdata[0]->id;
        $channel_like_exist=channels_posts_likes::where('channels_posts_id', $post_id)->where('users_id',$userid)->get();
        if(count($channel_like_exist)==0)
        {
            $channels_posts_likes = new channels_posts_likes;
            $channels_posts_likes->channels_posts_id = $post_id;
            $channels_posts_likes->users_id = $userid;
            $channels_posts_likes->save();
            $manual = 0;  // because the push notification is being sent by system
            $receiver_id =array($postdata[0]->users_id);
            $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
            $receivers_token = array_column($receivers, 'fcm_token');
            $fcm_token = $receivers_token;
            $sender_id = $userid;
            $title = "New Like on your Post";
            $body = $userdata[0]->first_name." ". $userdata[0]->last_name." has liked your Post";
            if(count($fcm_token) > 0)
            {
                sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');
            }
            saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

            $response = [
                'success' => true,
                'message' => "Post has been liked successfully",
            ];
            $code=200;
        }else{
            $response = [
                'success' => false,
                'message' => "You have already liked this Post",
            ];
            $code = 404;
        }
        return response()->json($response, $code);
     }

     public function CreateLikeOnPost(Request $request)
     {
       $google_id = $request->google_id;
       $post_id = $request->post_id;
       $postdata = channels_posts::where('id',  $post_id)->get();
       $userdata = User::where('google_id', $google_id)->get();
       $userid=$userdata[0]->id;
       $channel_like_exist=channels_posts_likes::where('channels_posts_id', $post_id)->where('users_id',$userid)->get();
       if(count($channel_like_exist)==0)
       {
           $channels_posts_likes = new channels_posts_likes;
           $channels_posts_likes->channels_posts_id = $post_id;
           $channels_posts_likes->users_id = $userid;
           $channels_posts_likes->save();
           $manual = 0;  // because the push notification is being sent by system
           $receiver_id =array($postdata[0]->users_id);
           $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
           $receivers_token = array_column($receivers, 'fcm_token');
           $fcm_token = $receivers_token;
           $sender_id = $userid;
           $title = "New Like on your Post";
           $body = $userdata[0]->first_name." ". $userdata[0]->last_name." has liked your Post";
           if(count($fcm_token) > 0)
           {
               sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');
           }
           saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

           $response = [
               'success' => true,
               'message' => "Post has been liked successfully",
           ];
           $code=200;
       }else{
            $channel_like_exist=channels_posts_likes::where('channels_posts_id', $post_id)->where('users_id',$userid)->delete();
           $manual = 0;  // because the push notification is being sent by system
           $receiver_id =array($postdata[0]->users_id);
           $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
           $receivers_token = array_column($receivers, 'fcm_token');
           $fcm_token = $receivers_token;
           $sender_id = $userid;
           $title = "New Dislike on your Post";
           $body = $userdata[0]->first_name." ". $userdata[0]->last_name." has disliked your Post";
           if(count($fcm_token) > 0)
           {
               sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');
           }
           saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

           $response = [
               'success' => true,
               'message' => "Post has been disliked successfully",
           ];
           $code=200;
       }
       return response()->json($response, $code);
    }
      public function CreateCommentOnPost(Request $request){




        $google_id = $request->google_id;
        $post_id = $request->post_id;
        $postdata = channels_posts::where('id',  $post_id)->get();



        $userdata = User::where('google_id', $google_id)->get();
        $userid=$userdata[0]->id;


                $channels_posts_comments = new channels_posts_comments;
                $channels_posts_comments->channels_posts_id = $post_id;
                $channels_posts_comments->users_id = $userid;
                $channels_posts_comments->comment_text = $request->comment_text;
                $channels_posts_comments->status = "Active";
                $channels_posts_comments->save();




                $manual = 0;  // because the push notification is being sent by system
                $receiver_id =array($postdata[0]->users_id);


                $receivers = User::whereIn('id',$receiver_id)->whereNotNull('fcm_token')->select('fcm_token','id')->get()->toArray();
                $receivers_token = array_column($receivers, 'fcm_token');
                $fcm_token = $receivers_token;


                $sender_id = $userid;



                $title = "New Comment on your Post";
                $body = $userdata[0]->first_name." ". $userdata[0]->last_name." has Commented on your Post";
                if(count($fcm_token) > 0)
                {


                    sendNotification($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

                }

                saveNotificationsDB($title,$body,$fcm_token,$manual,$receiver_id,$sender_id,null,'connect');

                $response = [
                    'success' => true,
                    'message' => "Comment has been posted successfully",
                ];
                return response()->json($response, 200);




       }




       public function DeleteComment(Request $request){

        $comment_id = $request->comment_id;

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





                channels_posts_comments::where('id', $comment_id)->delete();

                $response = [
                    'success' => true,
                    'message' => "The Comment has been deleted successfully",
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





       public function DeletePost(Request $request){

        $post_id = $request->post_id;

        $google_id = $request->google_id;
        $usersaveddata = User::where('google_id', $google_id)->get();

        if (count($usersaveddata) > 0) {
            $userid = $usersaveddata[0]->id;
            $userroles = implode(',', User::find($userid)->getRoleNames()->toArray());
            $userroles_ = str_replace(" ", "_", $userroles);
            $rolesarr = explode(",", $userroles_);
            $authorized_roles = array("Super_Admin", "Admin");
            $result = array_intersect($authorized_roles, $rolesarr);
            $owner = channels_posts::find($post_id);
            if (count($result) > 0 || $owner->users_id == $userid) {





                channels_posts::where('id', $post_id)->delete();

                channels_posts_comments::where('channels_posts_id', $post_id)->delete();
                channels_posts_likes::where('channels_posts_id', $post_id)->delete();




                $response = [
                    'success' => true,
                    'message' => "The Post has been deleted successfully",
                ];
                return response()->json($response, 200);


            } else {
                $error = 'This user must be author of this post or have rights of Super admin to perform this operation';
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


       public function getWelcomeMessage(Request $request){



        $response = [
            'success' => true,
            'data' => "Hello {}!, Join our tech community, comment, like and post pictures related to technology!",
        ];
        return response()->json($response, 200);

       }



}
