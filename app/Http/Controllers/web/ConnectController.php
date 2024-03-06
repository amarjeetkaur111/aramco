<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apis\channels;
use App\Models\Apis\channels_posts;
use App\Models\Apis\channels_posts_comments;
use App\Models\Apis\channels_posts_likes;
use Carbon\Carbon;
class ConnectController extends Controller
{
    private $connectController, $userController;
    public function __construct()
    {
        $this->connectController = new \App\Http\Controllers\admin\Apis\ConnectSystemController();
        $this->userController = new \App\Http\Controllers\admin\Apis\UserController();
    }
    // public function connect(){
    //    $channelsList = $this->connectController->GetAllChannels();
    //     return view('pages.web.connect.connect');
    // }
    public function connect(Request $request){
        if(auth()->user()->hasRole('Admin')){
            $query = channels::with('channels_posts_limit')->with('channels_posts_limit.user')->withCount('channels_posts')->orderBy('created_at', 'DESC');
        }else{
            $query = channels::with('channels_posts_limit')->with('channels_posts_limit.user')->withCount('channels_posts')->where('status','Active')->orderBy('created_at', 'DESC');
        }
        $channelsList = $query->paginate(10);
        $total = ceil($query->count() / 10);
        // dd($total);
        if ($request->ajax()) {
            $view = view('pages.web.connect.channel-data', ['channelsList' => $channelsList, 'total' => $total])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.connect.connect', [
            'channelsList' => $channelsList,
        ]);
    }

    public function internalChannel(){
        return view('pages.web.connect.internal-channel');
    }
    public function addChannel(){
        // return 'Connect Page';
        return view('pages.web.connect.add-channel');
    }

    public function addChannelPost(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required|file|mimes:jpeg,png,pdf|max:2048',
         ]);
        $google_id = Session('auth_google_id');

        $request->merge(["google_id"=>$google_id]);
 
         try {
             $response = $this->connectController->CreateChannel($request);
            if ($response->getData()->success){
                return redirect()->route('connect-connect')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
             }else{
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
             }
         }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
         }
    }

    public function newPost($id)
    {
        return view('pages.web.connect.new-post',['id'=>$id]);
    }
    
    public function createpost(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'post_text' => 'required',
         ]);
        $google_id = Session('auth_google_id');

        $request->merge(["google_id"=>$google_id]);
 
         try {
             $response = $this->connectController->CreatePost($request);
            if ($response->getData()->success){
                return redirect()->route('connect-internalChannels',$request->channel_id)->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
             }else{
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
             }
         }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
         }
    }

    public function internalChannels($id)
    {
        $channel = channels::with('channels_posts.user','channels_posts.channels_posts_likes','channels_posts.channels_posts_comments.user')->find($id);
        if($channel)
        {
            $channelList = channels::where('status','Active')->get();                       
            // echo"<pre>";print_r($channel->toArray());exit();
            return view('pages.web.connect.internal-channel',['list'=> $channelList,'channel'=>$channel,'id' => $id]);
        }
        else
        {
            return view('pages.web.connect.404-error');
        
        }
    }

    public function deletePost(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
            $response = $this->connectController->DeletePost($request);
           if ($response->getData()->success){
            return response()->json($response->getData());   
            }else{
                return response()->json($response->getData());
            }
        }catch (\Exception $e){
            return response()->json($e);
        }
    }

    public function myPosts()
    {
        $user_id = auth()->user()->id;
        $posts = channels_posts::with('user','channels_posts_likes','channels_posts_comments.user')->where('users_id',$user_id)->get();
            // echo"<pre>";print_r($channel->toArray());exit();
        return view('pages.web.connect.my-posts',['posts'=>$posts]);
    }

    public function deleteChannel(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
            $response = $this->connectController->DeleteChannel($request);
           if ($response->getData()->success){
            return response()->json($response->getData());   
            // return redirect()->route('connect-connect')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            }else{
                return response()->json($response->getData());
            //    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
            }
        }catch (\Exception $e){
            return response()->json($e);
        }
    }

    public function blockUnblockChannel(Request $request){
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        if($request->code=='block'){
            try {
                $response = $this->connectController->BlockChannel($request);
               if ($response->getData()->success){
                return response()->json($response->getData());   
                }else{
                    return response()->json($response->getData());
                }
            }catch (\Exception $e){
                return response()->json($e);
            }
        }else{
            try {
                $response = $this->connectController->UnBlockChannel($request);
               if ($response->getData()->success){
                return response()->json($response->getData());   
                }else{
                    return response()->json($response->getData());
                }
            }catch (\Exception $e){
                return response()->json($e);
            }
        }
    }

    public function createComment(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
            $response = $this->connectController->CreateCommentOnPost($request);
            if ($response->getData()->success){
                return response()->json(['success' => true]);   
            }else{
                return response()->json(['success' => false]);
            }
        }catch (\Exception $e){
           return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
    }

    public function createLike(Request $request)
    {
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
            $response = $this->connectController->CreateLikeOnPost($request);
            if ($response->getData()->success){
                return response()->json(['success' => true]);   
            }else{
                return response()->json(['success' => false]);
            }
        }catch (\Exception $e){
           return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
    }

    public function getReceiverNotifications()
    {
        $google_id = Session('auth_google_id');
        $request = new Request;
        $request->merge(["google_id"=>$google_id]);
        try {
            $response = $this->userController->getReceiverNotifications($request);
            if ($response->getData()->success){
                $data = $response->getData()->data;
                $connect_data = array_filter($data,function ($item) {
                    if($item->module == 'connect')
                        return $item;
                });

                $connect_data_new = array_map(function ($item) {
                    $date =  Carbon::parse($item->created_at) ;
                    $item->created_at_ago = $date->diffForHumans();
                    $item->time = date('h:m A',strtotime($item->created_at));
                    return $item;
                },$connect_data);

                return response()->json(['success' => true,'result' => $connect_data_new]);   
            }else{
                return response()->json(['success' => false]);
            }
        }catch (\Exception $e){
           return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
    }
}
