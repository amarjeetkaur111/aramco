<?php

namespace App\Http\Controllers\web\Services;
use App\Http\Controllers\Controller;
use App\Models\Apis\schedule_visit;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;
use Illuminate\Support\Facades\Auth;

class ScheduleVisitController extends Controller
{
    //
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }

    public function requestScheduleVisit(){
        $action = route('services-postScheduleVisit');
        return view('pages.web.services.scheduleVisit.schedule-visit',compact('action'));
    }

    public function postScheduleVisit(Request $request)
    {
        $this->validate($request, [
            'visit_title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_visitors' => 'required',
            'visitor_coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        $start_date = $request->start_date;
        $request->start_date = date('Y-m-d H:i:s', strtotime("$start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$start_date $request->end_time"));
        $response = $this->ReservationController->scheduleVisitRequest($request);
        if($response->getData()->data)
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' =>'Schedule Visit Request Submitted Successfully']);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
    }

    public function scheduleVisitList(Request $request)
    {
        // dd('hs');
        $getVisitSchedules = schedule_visit::with('user')->orderBy('created_at', 'DESC')->get();
// dd($getVisitSchedules->toArray());
        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getVisitSchedules, 'action' => 'services-admin-schedule-visit-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.scheduleVisit.manage-schedule-visit', ['lists' => $getVisitSchedules, 'action' => 'services-admin-schedule-visit-view']);
    }


    public function scheduleVisitDetail(int $id)
    {
        $getVisitSchedule = schedule_visit::with('user')->find($id);
        return view('pages.web.services.scheduleVisit.manage-schedule-visit-form', compact('getVisitSchedule'));
    }

    public function canclescheduleVisitDetail(int $id)
    {
        $getVisitSchedule = schedule_visit::with('user')->find($id);
        return view('pages.web.services.scheduleVisit.manage-cancellation-schedule-visit-form', compact('getVisitSchedule'));
    }

    public function scheduleVisitChangeStatus(Request $request)
    {
        $this->validate($request, [
            'visit_title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_visitors' => 'required',
            'visitor_coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
            $response = $this->ReservationController->ChangeScheduleVisitRequestStatus($request);

            if ($response->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

        if ($request->status_of_request == "modify") {
            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->end_time"));
            $response = $this->ReservationController->updateScheduleVisitRequest($request);

            if($response->getData()->data)
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
        }
    }

    // My Activity Functionalities

    public function getUserScheduleVisits(Request $request)
    {
        $users_id = Session('auth_userid');
        // $getVisitSchedules = schedule_visit::where('users_id',$users_id)->orderBy('schedule_visit_request.created_at', 'DESC')->paginate(10);
        $getVisitSchedules = schedule_visit::where('users_id',$users_id)->orderBy('schedule_visit_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getVisitSchedules, 'type'=>'visit', 'action' => 'services-my-schedule-visits-edit', 'actionShow' => 'services-my-schedule-visits-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.scheduleVisit.my-schedule-visit-list', ['lists' => $getVisitSchedules,'type'=>'visit', 'action' => 'services-my-schedule-visits-edit', 'actionShow' => 'services-my-schedule-visits-show']);
    }

    public function editScheduleVisits($id){
        $data_id = Auth::id();
        $scheduleVisit = schedule_visit::find($id);
        $showMode = false;
        return view('pages.web.services.scheduleVisit.edit-schedule-visit',compact('scheduleVisit','showMode'));
    }
    public function showScheduleVisits($id){
        $data_id = Auth::id();
        $scheduleVisit = schedule_visit::find($id);
        $showMode = true;
        return view('pages.web.services.scheduleVisit.edit-schedule-visit',compact('scheduleVisit','showMode'));
    }

    public function editScheduleVisitsPost(Request $request){
        $this->validate($request, [
            'visit_title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_visitors' => 'required',
            'visitor_coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->end_time"));
        $response = $this->ReservationController->updateScheduleVisitRequest($request);

        if($response->getData()->data)
            return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);

    }

    public function cancelscheduleVisitList(Request $request)
    {
        $getVisitSchedules = schedule_visit::with('user')->where('is_approval_needed',1)->where('is_cancellation_approved','Pending')->orderBy('schedule_visit_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getVisitSchedules, 'action' => 'services-admin-cancel-schedule-visit-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.scheduleVisit.manage-cancellation-schedule-visit', ['lists' => $getVisitSchedules, 'action' => 'services-admin-cancel-schedule-visit-view']);
    }

    public function cancelscheduleVisiPost(Request $request)
    {
        if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
            $response = $this->ReservationController->approveCancelVisitRequest($request);

            if ($response->getData()->success) {
                return redirect()->route('services-admin-cancel-schedule-visit-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->route('services-admin-cancel-schedule-visit-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

    }
}
