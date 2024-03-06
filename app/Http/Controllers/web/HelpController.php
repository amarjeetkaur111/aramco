<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Apis\help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HelpController extends Controller
{
    private $helpController;
    public function __construct()
    {
        $this->helpController = new \App\Http\Controllers\admin\Apis\HelpController();
    }
    //
    public function index(): View
    {
        return view('pages.web.help.submit-request');
    }

    public function storeSubmitRequest(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'comment' => 'required',
        ]);

        try {
            $response = $this->helpController->SendHelpRequest($request);
            if ($response->getData()->success){
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->data]);
            }else{
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
            }
        }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
    }

    public function oldRequest(Request $request)
    {
        $query = help::with('user:id,email')->where('users_id', Auth::user()->id)->orderBy('created_at', 'DESC');
        // dd($query);
        $helps = $query->paginate(10);
        // dd($helps);
        $total = ceil($query->count() / 10);
        // dd($total);
        if ($request->ajax()) {
            $view = view('pages.web.help.load-data', compact('helps', 'total'))->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.help.old-request', compact('helps', 'total'));
    }

// Admin Functions //

    public function showHelprequests(Request $request){
        $query = help::with('user')->orderBy('created_at', 'DESC');
        // dd($query);
        $helps = $query->paginate(10);
        $action= 'help-admin-help-system-query';
        if ($request->ajax()) {
            $view = view('pages.web.help.admin.load-data', compact('helps','action'))->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.help.admin.help-system-management', compact('helps','action'));
    }

    public function showHelprequestsDetail($id)
    {
        $query = help::with('user')->where('id',$id)->get();
        // dd($query);
        if(count($query) > 0){
            $data = $query[0];
            return view('pages.web.help.admin.help-system-feedback',compact('data'));
        }else{
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
        }
        
    }

    public function adminHelprequestComment(Request $request){
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        try {
            // dd('hello');
             $response = $this->helpController->RespondHelpRequest($request);
            //  dd($response);
             if ($response->getData()->success){
                
                 return redirect()->route('help-admin-help-system-management')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->data]);
             }else{
                // dd('elsre');
                 return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
             }
         }catch (\Exception $e){
             return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Something went wrong']);
         }
    }

}
