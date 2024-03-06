<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Apis\User;
use App\Models\Apis\country;
use App\Http\Controllers\admin\Apis\UserController;
use App\Http\Controllers\admin\Apis\ControlSystemController;
use App\Models\Apis\controlsystem;
use Auth;
use App\Models\Apis\profile_completion_requests;

class UserManagement extends Controller
{
    private $UserController;
    private $controlController;
    public function __construct()
    {
        $this->UserController = new UserController();
        $this->controlController = new ControlSystemController();
    }

    public function profile()
    {
        $auth_userid = Session::get('auth_userid');
        $data = User::find($auth_userid);
        $countries = country::all();
        $pc = profile_completion_requests::where('users_id',$data->id)->latest()->first();
        // echo"<pre>";print_r($pc);exit();

        if($pc)
        {
            if($pc->status == 'Approved')
                $hidden_status = 'approved';
            elseif($pc->status == 'Rejected')
                $hidden_status = 'rejected';
            else
                $hidden_status = 'pending';
        }
        else
            $hidden_status = 'new';
        //how to find profile is REJECTED!!
        // echo"<pre>";print_r($hidden_status);exit();
        return view('pages.web.login.profile',compact('data','hidden_status','countries'));
    }

    public function postprofile(Request $request)
    {
        $this->validate($request, [
            'google_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'phone' => 'required',
            'job_experience' => 'required',
        ]);
        // dd($request->all());

        if($request->hidden_status == 'new' || $request->hidden_status == 'rejected')
        {
            $response = $this->UserController->updateUserProfile($request);
            if($response->getData()->data)
            {
                $profileCompletitionRequest = $this->UserController->profileCompletitionRequest($request);
                if($profileCompletitionRequest->getData()->data)
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Profile Request Submitted Successfully!']);
                else
                    return redirect()->back()->with(['status' => 'Error', 'class' => 'danger', 'msg' => "Profile Request Could Not be Submitted! Try Again Later!"]);

            }
            else
                return redirect()->back()->with(['status' => 'Error', 'class' => 'danger', 'msg' => "Profile Request Could Not be Submitted! Try Again Later!"]);
        }
        elseif($request->hidden_status == 'approved'){
            $response = $this->UserController->updateUserProfile($request);
            Session::put('profile_img', Auth::user()->profile_photo);
            if($response->getData()->data)
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Profile Request Submitted Successfully!']);
            else
                return redirect()->back()->with(['status' => 'Error', 'class' => 'danger', 'msg' => "Profile Request Could Not be Submitted! Try Again Later!"]);
        }

    }

    public function profile_list(Request $request,$status=null)
    {
        // $request = new Request;
        // $request->merge(['google_id' => Auth::user()->google_id]);
        // $profiles = $this->UserController->getAllProfilerequests($request);
        // $profiles = $profiles->getData()->data;
        // // echo"<pre>";print_r($profiles->getData()->data);exit();
        // return view('pages.web.profiles.user-completion',compact('profiles'));
        if($status == null)
            $profiles = profile_completion_requests::orderBy('id','DESC')->paginate(10);
        else
            $profiles = profile_completion_requests::where('status',$status)->orderBy('id','DESC')->paginate(10);
        if ($request->ajax()) {
            $status = $request->status;
            if($status == null)
                $profiles = profile_completion_requests::orderBy('id','DESC')->paginate(10);
            else
                $profiles = profile_completion_requests::where('status',$status)->orderBy('id','DESC')->paginate(10);
            $view = view('pages.web.profiles.load-pending-data', compact('profiles'))->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.profiles.user-completion', compact('profiles'));
    }
    public function pending_user($id)
    {
        $data = profile_completion_requests::find($id);
        $countries = country::all();
        return view('pages.web.profiles.user-completion-form',compact('data','countries'));
    }

    public function change_status(Request $request)
    {
        $request->merge(['google_id' => Auth::user()->google_id]);
        //dd($request->all());
        $profiles = $this->UserController->ChangeProfileRequestStatus($request);

        $response = $profiles->getData();

        return response()->json($response);
    }

    public function users_list(Request $request,$status=null)
    {
        if($status == null)
            $profiles = User::with('roles')->orderBy('id','DESC')->get();
        else
            $profiles = User::with('roles')->whereHas(
                'roles', function($q) use($status){
                    $q->where('name', $status);
                })->orderBy('id','DESC')->get();

        if ($request->ajax()) {
            $status = $request->status;
            if($status == null)
                $profiles = User::with('roles')->orderBy('id','DESC')->get();
            else
                $profiles = User::with('roles')->whereHas(
                'roles', function($q) use($status){
                    $q->where('name', $status);
                })->orderBy('id','DESC')->get();
            $view = view('pages.web.profiles.load-user-data', compact('profiles'))->render();
            return response()->json(['html' => $view]);
        }

        // echo"<pre>";print_r($profiles->toArray());exit();
        return view('pages.web.profiles.users-list', compact('profiles'));
    }
    public function user_details($id)
    {
        $data = User::with('roles')->find($id);
        $countries = country::all();
        return view('pages.web.profiles.users-detail',compact('data','countries'));
    }

    //User Control Functions starts here

    public function generalControl(){
        // dd('hh');
        return view('pages.web.user_control.general-control');
    }

    public function usersControl(Request $request){
        $userData = User::where('status','Approved')->orderBy('created_at', 'DESC')->get();
        // $userData = $query->paginate(10);
        $action= 'user-control-user-control-settings';
        if ($request->ajax()) {
            $view = view('pages.web.user_control.user_internal', compact('userData','action'))->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.user_control.user-control-new',compact('userData','action'));
       
    }

    public function generalPost(Request $request){
        // dd($request->all());
        $admin_google_id = Session('auth_google_id');
        $request->merge([
            'admin_google_id'=>$admin_google_id,]);

        if($request->has('general')){
            $request->merge([
                'schedule_request'=>1,
                'robin_event_request'=>1,
                'incubator_request'=>1,
                'computing_resource_request'=>1,
                'technology_workshop_request'=>1,
                'idea_request'=>1,
                'general_reservation_request'=>1,
            ]);
        }
        if($request->has('connect')){
            $request->merge([
                'connect'=>1,]);
        }
        if($request->has('help')){
            $request->merge([
                'help'=>1,]);
        }
        if($request->has('help')){
            $request->merge([
                'help'=>1,]);
        }
        if($request->has('calendar')){
            $request->merge([
                'calendar'=>1,]);
        }
        try {
            $response = $this->controlController->ModifyUsersControlAll($request);
            if($response->getData()->success){
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            }else{
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
            }
        }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }

    }

    public function userControlSettings(Request $request, $id)
    {
        $user_data = User::find($id);
        $google_id = $user_data->google_id;
            $request->merge([
                'google_id'=>array($google_id)]);
                
        if(!empty($google_id)){
            $response = $this->controlController->getUsersControl($request);
            // dd($response);
            
                $accessData = $response->getData()->data;
                if(empty($accessData)){
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'No Data Available']);

                }
                // dd($accessData);
           
            
            
            if($response->getData()->success){
                return view('pages.web.user_control.user-control-settings',compact('user_data','accessData','google_id'));
            }
            // dd($response);
        }else{
            
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);

        }
        // return view('pages.web.user_control.user-control-settings',compact('user_data'));
    }

    public function userControlPost(Request $request){
       
        $admin_google_id = Session('auth_google_id');
        $request->merge([
            'admin_google_id'=>$admin_google_id,]);

            // dd($request->all());

        try {
            $response = $this->controlController->ModifyUsersControl($request);
            if($response->getData()->success){
                // dd('one');
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            }else{
                // dd('two');
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
            }
        }catch (\Exception $e){
            // dd($e);
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
    }

    public function multipleUserControlSettings(Request $request){
        // $idArray = explode('/', $ids);
        // dd($request->google_id);
        $idArray = $request->google_id;
        // dd($idArray);
        return view('pages.web.user_control.bulk-user-control-settings',compact('idArray'));
    }

    public function multipleUserControlPost(Request $request){
        // dd($request->all());

        $admin_google_id = Session('auth_google_id');
        $users_google_id = json_decode($request->google_id[0],true);
        // dd($users_google_id);

        $schedule_request=[];
        $robin_event_request=[];
        $incubator_request=[];
        $computing_resource_request=[];
        $technology_workshop_request=[];
        $idea_request=[];
        $general_reservation_request=[];
        $calendar=[];
        $help=[];
        $connect=[];
        $ar=[];

        
        
        foreach($users_google_id as $key =>$value){

            $schedule_request[]=$request->schedule_request;
           $robin_event_request[]=$request->robin_event_request;
            $incubator_request[]=$request->incubator_request;
            $computing_resource_request[]=$request->computing_resource_request;
            $technology_workshop_request[]=$request->technology_workshop_request;
            $idea_request[]=$request->idea_request;
            $general_reservation_request[]=$request->general_reservation_request;
            $calendar[]=$request->calendar;
            $help[]=$request->help;
            $connect[]=$request->connect;
            $ar[]=$request->ar;
          
        }
        // dd($schedule_request);
        $request->merge([    
            'schedule_request' => $schedule_request,
            'admin_google_id'=>$admin_google_id,
            'google_id' => $users_google_id,
            'robin_event_request' => $robin_event_request,
            'incubator_request' => $incubator_request,
            'computing_resource_request' => $computing_resource_request,
            'technology_workshop_request' => $technology_workshop_request,
            'idea_request' => $idea_request,
            'general_reservation_request' => $general_reservation_request,
            'calendar' => $calendar,
            'help' => $help,
            'connect' => $connect,
            'ar' => $ar,
        ]);
        // dd($request->all());
        try {
            $response = $this->controlController->ModifyUsersControl($request);
            if($response->getData()->success){
                // dd('one');
                return redirect()->route('user-control-users')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            }else{
                // dd('two');
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
            }
        }catch (\Exception $e){
            // dd($e);
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
        // dd($idsArray);
    }
    public function giveUserAccess(Request $request)
    {
        if(Auth::check()){

        
        $data = controlsystem::where('users_id',Auth()->id())->get();
        
        $letgo=0;
        if(count($data) > 0){
            // dd("lets go :" .$letgo);
        
        $userData = $data[0];
        $value = $request->linktype;

       
        
        if($value=="sc_visit" && $userData->schedule_request == 1){
            // dd('here');
            $letgo=1;
        }
        if($value=="connect" && $userData->connect == 1){
            $letgo=1;
        }
        if($value=="helpp" && $userData->help == 1){
            $letgo=1;
        }
        if($value=="calendar" && $userData->calendar == 1){
            $letgo=1;
        }
        if($value=="allocate_visit" && $userData->computing_resource_request == 1){
            $letgo=1;
        }
        if($value=="technology" && $userData->technology_workshop_request == 1){
            $letgo=1;
        }
        if($value=="idea" && $userData->idea_request == 1){
            $letgo=1;
        }
        if($value=="general" && $userData->general_reservation_request == 1){
            $letgo=1;
        }
        if($value=="incubator" && $userData->incubator_request == 1){
            $letgo=1;
        }
        if($value=="host_event" && $userData->robin_event_request == 1){
            $letgo=1;
        }
        // dd($letgo);
         return response()->json( $letgo);
        // return $next($request);
    }else{
        return response()->json( $letgo);
    }
}else{
    $letgo=2;
    return response()->json( $letgo);
}
}
}
