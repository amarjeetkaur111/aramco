<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Apis\feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    private $feedbackController;
    public function __construct()
    {
        $this->feedbackController = new \App\Http\Controllers\admin\Apis\UserController();
    }
    //
    public function index(Request $request){
        $query = feedback::with('user')->orderBy('created_at', 'DESC');
        // dd($query);
        $feedback = $query->paginate(10);
        // dd($feedback);
        $action= 'feedback-admin-admin-feedback';
        if ($request->ajax()) {
            $view = view('pages.web.feedback.load-data', compact('feedback','action'))->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.feedback.feedback-system-management', compact('feedback','action'));
    }

    public function showFeedbackDetail($id)
    {
        $query = feedback::with('user')->where('id',$id)->get();
        // dd($query);
        if(count($query) > 0){
            $data = $query[0];
            return view('pages.web.feedback.feedback_comment_admin',compact('data'));
        }else{
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
        
    }

    public function adminFeedbackrequestComment(Request $request){
        // dd($request->all());
        $this->validate($request ,[
            "comment" =>"required",
        ]);
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
             $response = $this->feedbackController->Respondfeedback($request);
             if ($response->getData()->success){
                 return redirect()->route('feedback-admin-index')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->data]);
             }else{
                 return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
             }
         }catch (\Exception $e){
             return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
         }
    }
}
