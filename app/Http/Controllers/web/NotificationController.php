<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\UserController;
use App\Models\Apis\User;
use App\Models\Apis\notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    private $UserController;
    public function __construct()
    {
        $this->UserController = new UserController();
    }

    public function index()
    {
        $request = new Request();
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        $response = $this->UserController->getReceiverNotifications($request);
        // dd($response);
        $data = $response->getData()->data;

        array_map(function ($item) {
            return $item->created_at = Carbon::parse($item->created_at)->timezone('Asia/Dubai')->toDateTimeString();;
        },$data);

        // echo"<pre>";print_r($data);exit();
        return view('pages.web.notification.notifications',compact(['data']));
    }

    public function sendFeedback(Request $request)
    {
        // dd($request->all());
        $response = $this->UserController->Sendfeedback($request);
        if ($response->getData()->success) {
            $request->merge(["is_feedback_on"=>'0']);
            $this->UserController->FeedbackOnFlag($request);
            return redirect()->route('notification-index')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->data]);
        } else {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong! Try again!']);
        }
    }

    public function pushNotification(Request $request)
    {
        $getUsers = User::select('google_id','first_name','last_name','email')->get();
        $id = auth()->user()->id;
        $notifications = notification::with('receiver')->where('sender_id',$id)->where('manual',1)->orderBy('created_at', 'DESC')->paginate(10);
        // echo"<pre>";print_r($notifications->toArray());exit();

        if ($request->ajax()) {
            $view = view('pages.web.notification.load-data', ['lists' => $notifications,'getUsers'=> $getUsers, 'action' => 'notification-admin-notificationDetail'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.notification.push-notification', ['lists' => $notifications,'getUsers'=> $getUsers, 'action' => 'notification-admin-notificationDetail']);

        // return view('pages.web.notification.push-notification',compact(['getUsers']));
    }

    public function pushNotificationPost(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'receiver_id' => 'required',
        ]);

        $response = $this->UserController->notificationAPI($request);
        if ($response->getData()->success) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
        } else {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong! Try again!']);
        }
    }

    public function notificationDetail($id)
    {
        $notifications = notification::with('receiver')->where('id',$id)->get();
        // echo"<pre>";print_r($notifications->toArray());exit();
        return view('pages.web.notification.pushed-notification',['data' => $notifications[0]]);
    }
    public function notificationHistory(Request $request)
    {
        $id = auth()->user()->id;
        $notifications = notification::with('receiver')->where('sender_id',$id)->where('manual',1)->orderBy('created_at', 'DESC')->paginate(10);
        if ($request->ajax()) {
            $view = view('pages.web.notification.load-data', ['lists' => $notifications,'action' => 'notification-admin-notificationDetail'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.notification.history', ['lists' => $notifications,'action' => 'notification-admin-notificationDetail']);

    }
}
