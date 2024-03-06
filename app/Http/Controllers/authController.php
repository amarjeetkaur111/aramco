<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Apis\User;
use Spatie\Permission\Models\Role;
use Session;
use Validator;
use App\Http\Controllers\admin\Apis\UserController;

// use Illuminate\Foundation\Auth\RegistersUsers;

class authController extends Controller
{
    private $UserController;
    public function __construct()
    {
        $this->UserController = new UserController();
    }

    public function signInwithGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
    public function callbackToGoogle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            $google2fa = app('pragmarx.google2fa');
            if($finduser && $finduser->factor_secret_key){               
                    $registration_data = [
                        'first_name' => $finduser->first_name,
                        'last_name' => $finduser->last_name,
                        'email' => $finduser->email,
                        'google_id'=> $finduser->google_id,
                        'factor_secret_key' => $finduser->factor_secret_key,
                        'section' => '2',
                    ];
    
                    Session::flash('registration_data', $registration_data);
    
                     $QR_Image = $google2fa->getQRCodeInline(
                        config('app.name'),
                        $registration_data['email'],
                        $registration_data['factor_secret_key']
                    );
                    Session::put('auth_google_id', $finduser->google_id);
                    return view('pages.web.login.login',['section' => '2','QR_Image' => '', 'secret' => '']);
               
            }else{
                 //echo'<pre>';print_r($user); exit();
                 $factor_secret_key = $google2fa->generateSecretKey();
                 $registration_data = [
                    'first_name' => $user->user['given_name'] ?? '',
                    'last_name' => $user->user['family_name'] ?? '',
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'factor_secret_key' => $factor_secret_key,
                    'section' => '3',
                ];

                $newrequest = new Request;
                $newrequest->merge([ 
                    'first_name' => $user->user['given_name'] ?? '',
                    'last_name' => $user->user['family_name'] ?? '',
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'factor_secret_key' => $factor_secret_key,

                    'google_secret_key'=> '',
                    'facial_analysis_photo'=> '',
                    'dob'=> '',
                    'gender'=> '',
                    'nationality'=> '',
                    'job_experience'=> '',
                    'twitter_account'=> '',
                    'linkedin_account'=> '',
                    'phone'=> '',
                ]);

                //create user
                Session::flash('registration_data', $registration_data);

                 $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $registration_data['email'],
                    $registration_data['factor_secret_key']
                );
                // $newUser = User::create($registration_data);
                // $role = Role::where('id',3)->first();
                // $newUser->assignRole($role);
                $userCreate = $this->UserController->createUser($newrequest);
                if ($userCreate->getData()->success)
                    Session::put('auth_google_id', $userCreate->getData()->data->google_id);
                else
                    Session::put('auth_google_id', $user->id);
                    // return 'Something went wrong!';
                    
                return view('pages.web.login.login',['section' => '3','QR_Image' => $QR_Image, 'secret' => $registration_data['factor_secret_key']]);            
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function completeRegistration(Request $request)
    {        
        $registration_data = session('registration_data');
        $request->merge(session('registration_data'));
        //  echo'<pre>';print_r($request->all()); exit();
       
        $google2fa = app('pragmarx.google2fa');
        $validator =  Validator::make($request->all(), [
            '2fa_code' => 'required',
        ]);
        
        if ($validator->fails()) {
            Session::flash('registration_data', $registration_data);
            Session::flash('status','Error');
            Session::flash('class' ,'danger');
            Session::flash('msg', "Code is Required!");
            
            if($request->section == 2)
                return view('pages.web.login.login',['section' => $request->section,'QR_Image' => '', 'secret' => '']);    
            elseif($request->section == 3)
            {
                $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $registration_data['email'],
                    $registration_data['factor_secret_key']
                );
                return view('pages.web.login.login',['section' => $request->section,'QR_Image' => $QR_Image, 'secret' => $registration_data['factor_secret_key']]);    
            }
            // return redirect('/login')->with(['section' => $request->section ,'status' => 'Error', 'class' => 'danger', 'msg' => "Code is Required!"]);
        }
      
        $valid = $google2fa->verifyKey(
            $request->input('factor_secret_key'),
            $request->input('2fa_code')
        );

        if ($valid) {
            $finduser = User::where('google_id', $request->google_id)->first();
            $roleid = $finduser->roles->first()->id;
            $auth_google_id = $finduser->google_id;
            $auth_userid = $finduser->id;
            
            Auth::guard('web')->login($finduser);
            Session::put('profile_img', Auth::user()->profile_photo) ?? '';
            Session::put('roleid', $roleid);
            Session::put('auth_google_id', $auth_google_id);
            Session::put('auth_userid', $auth_userid);

            $newreq = new Request;
            $newreq->merge(['user_google_id' => $request->google_id]);
            $reg_answers = $this->UserController->getuserAnswers($newreq);
            if($reg_answers->getData()->data)
            {
                // if(Auth::user()->roles->first()->id == '3')
                //     return redirect()->route('user-profile');
                // else
                    return redirect()->route('index');
            }
            else
            {
                $first_timer = 'new';
                return redirect()->route('qna',['first_timer' => $first_timer]);
            }
        //     return 'working';
        } 
        else {
            Session::flash('registration_data', $registration_data);
            Session::flash('status','Error');
            Session::flash('class' ,'danger');
            Session::flash('msg', "Code Did Not Match! Try Again!");
            
            if($request->section == 2)
                return view('pages.web.login.login',['section' => $request->section,'QR_Image' => '', 'secret' => '']);    
            elseif($request->section == 3)
            {
                $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $registration_data['email'],
                    $registration_data['factor_secret_key']
                );
                return view('pages.web.login.login',['section' => $request->section,'QR_Image' => $QR_Image, 'secret' => $registration_data['factor_secret_key']]);    
            }  

            // return redirect('/login')->with(['section' => '1','status' => 'Error', 'class' => 'danger', 'msg' => "Code is Required!"]);
        }
    }

    public function qna(Request $request,$first_timer)
    {
        $qna = $this->UserController->getQuestionaire($request);
        $qna = $qna->getData()->data;
        // echo'<pre>';print_r($qna[0]);exit();
        return view('pages.web.login.qna',compact('qna','first_timer'));
    }
    public function postqna(Request $request)
    {
        $this->validate($request, [
            'answers.*' => 'required',
            'question_ids.*' => 'required|integer',
        ]);
        if($request->first_timer == 'new' || $request->first_timer == 'old')
        {
            $response = $this->UserController->postAnswer($request);
            if($response->getData()->success == true)
                return redirect()->route('index');
            else
                return redirect()->back()->with(['status' => 'warning', 'class' => 'waring', 'msg' => "Something Went Wrong. Try again!"]);
        }
        // elseif($request->first_timer == 'old')
        // {
        //     $response = $this->UserController->postAnswer($request);
        //     if($response->getData()->success == true)
        //     {
        //         $finduser = User::where('google_id', $request->user_google_id)->first();
        //         $google2fa = app('pragmarx.google2fa');      
        //         $registration_data = [
        //             'first_name' => $finduser->first_name,
        //             'last_name' => $finduser->last_name,
        //             'email' => $finduser->email,
        //             'google_id'=> $finduser->google_id,
        //             'factor_secret_key' => $google2fa->generateSecretKey(),
        //             'section' => '3',
        //         ];
        //         Session::flash('registration_data', $registration_data);

        //         $QR_Image = $google2fa->getQRCodeInline(
        //             config('app.name'),
        //             $registration_data['email'],
        //             $registration_data['factor_secret_key']
        //         );
                
        //         return view('pages.web.login.login',['section' => '3','QR_Image' => $QR_Image, 'secret' => $registration_data['factor_secret_key']]);   
        //     }
        //     else
        //         return redirect()->back()->with(['status' => 'warning', 'class' => 'waring', 'msg' => "Something went wrong! Try again."]);

        // }
        elseif($request->first_timer == 'recover')
        {
            $reg_answers = $this->UserController->getuserAnswers($request);
            if($reg_answers->getData()->success)
            {
                $reg_answers = $reg_answers->getData()->data;
                // echo'<pre>';print_r($reg_answers);exit();
                foreach($reg_answers as $k => $ans)
                {
                    if($ans->answer != $request->answers[$k])
                    {
                        return redirect()->back()->with(['status' => 'warning', 'class' => 'waring', 'msg' => 'Answer No.  ' .($k+1). ' did not match with registered answer!']);
                    }
                }
                $finduser = User::where('google_id', $request->user_google_id)->first();
                $google2fa = app('pragmarx.google2fa');      
                $registration_data = [
                    'first_name' => $finduser->first_name,
                    'last_name' => $finduser->last_name,
                    'email' => $finduser->email,
                    'google_id'=> $finduser->google_id,
                    'factor_secret_key' => $google2fa->generateSecretKey(),
                    'section' => '3',
                ];
                Session::flash('registration_data', $registration_data);
                $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $registration_data['email'],
                    $registration_data['factor_secret_key']
                );
                
                User::where("google_id",$request->user_google_id)->update(["factor_secret_key" => $registration_data['factor_secret_key']]);

                return view('pages.web.login.login',['section' => '3','QR_Image' => $QR_Image, 'secret' => $registration_data['factor_secret_key']]);   
            }
            else
                return redirect()->back()->with(['status' => 'warning', 'class' => 'waring', 'msg' => $reg_answers->getData()->message]);
        }
        else
            return redirect()->back()->with(['status' => 'warning', 'class' => 'waring', 'msg' => "Kindly go through properly linking!"]);
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        Session::forget('profile_img');
        Session::flush();
        return redirect('/');
    }
}
