<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\general_reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;

class GeneralReservationController extends Controller
{
    //
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }

    public function generalResrvation(Request $request){
        return view('pages.web.services.generalReservation.general-reservation');
    }

    public function generalReserveStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'justification' => 'required',
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $request->start_date = date('Y-m-d H:i:s', strtotime("$start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$end_date $request->end_time"));
        $response = $this->ReservationController->generalReservation($request);
        if($response->getData()->data)
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' =>'General reservation Request Submitted Successfully']);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
    }

    public function generalReservationList(Request $request)
    {
        // $getGeneralReservation = general_reservation::with('user')->orderBy('general_reservation.created_at', 'DESC')->paginate(10);
        $getGeneralReservation = general_reservation::with('user')->orderBy('general_reservation.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getGeneralReservation, 'action' => 'services-admin-general-reservation-view'])->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.services.generalReservation.manage-general-reservation-list', ['lists' => $getGeneralReservation, 'action' => 'services-admin-general-reservation-view']);
    }

    public function generalReservationView(int $id)
    {
        $getGeneralVisit = general_reservation::with('user')->find($id);
        return view('pages.web.services.generalReservation.manage-general-reservation-form',compact('getGeneralVisit'));
    }

    public function generalreservationChangeStatus(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'justification' => 'required',
        ]);

        if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
            $response = $this->ReservationController->ChangeGeneralReservationStatus($request);

            if ($response->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

        if ($request->status_of_request == "modify") {
            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));
            $response = $this->ReservationController->updateGeneralReservation($request);

            if($response->getData()->data)
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
        }
    }
     // My General Rservation Functionalities
     public function getMyGeneralReservation(Request $request)
     {
         $users_id = Session('auth_userid');
         $getGeneral = general_reservation::where('users_id',$users_id)->orderBy('created_at', 'DESC')->paginate(10);

         if ($request->ajax()) {
             $view = view('pages.web.services.load-my-data', ['lists' => $getGeneral, 'type'=>'general', 'action' => 'services-my-general-reservation-edit', 'actionShow' => 'services-my-general-reservation-show'])->render();
             return response()->json(['html' => $view]);
         }

         return view('pages.web.services.generalReservation.my-general-request', ['lists' => $getGeneral, 'type'=>'general', 'action' => 'services-my-general-reservation-edit', 'actionShow' => 'services-my-general-reservation-show']);
     }

     public function editGenResReq(int $id)
    {
        $getGeneralVisit = general_reservation::with('user')->find($id);
        $showMode = false;
        return view('pages.web.services.generalReservation.edit-general-reservation',compact('showMode','getGeneralVisit'));
    }

    public function showGenResReq(int $id)
    {
        $getGeneralVisit = general_reservation::with('user')->find($id);
        $showMode = true;
        return view('pages.web.services.generalReservation.edit-general-reservation',compact('showMode','getGeneralVisit'));
    }

    public function editGeneralResReqEditPost(Request $request){
            $this->validate($request, [
                'title' => 'required',
                'start_date' => 'required',
                'start_time' => 'required',
                'end_date' => 'required',
                'end_time' => 'required',
                'description' => 'required',
                'justification' => 'required',
            ]);

            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));
            $response = $this->ReservationController->updateGeneralReservation($request);

            if($response->getData()->data)
                return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);

    }

    public function cancelGeneralReservationList(Request $request)
    {
        $getGeneralVisit = general_reservation::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('general_reservation.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getGeneralVisit, 'action' => 'services-admin-cancel-general-reservation-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.generalReservation.manage-cancellation-general-reservation', ['lists' => $getGeneralVisit, 'action' => 'services-admin-cancel-general-reservation-view']);
    }

    public function cancelGeneralReservationView($id)
    {
        $getGeneralVisit = general_reservation::with('user')->find($id);
        return view('pages.web.services.generalReservation.manage-cancellation-general-reservation-form', compact('getGeneralVisit'));
    }

    public function cancelGeneralReservation(Request $request)
    {
        if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
            $response = $this->ReservationController->approveCancelGeneralReservationRequest($request);

            if ($response->getData()->success) {
                return redirect()->route('services-admin-cancel-schedule-visit-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->route('services-admin-cancel-schedule-visit-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

    }
}
