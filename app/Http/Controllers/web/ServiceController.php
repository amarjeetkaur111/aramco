<?php

namespace App\Http\Controllers\web;
use App\Models\Apis\required_resource_list;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;

class ServiceController extends Controller
{
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }



    public function myactivity(Request $request){

        // dd(Session('auth_google_id'));
        // dd($request->all());
        $google_id = Session('auth_google_id');
        $request->merge(["google_id"=>$google_id]);
        $request->merge(["request_type"=>'visit']);

        $scheduleVisit = '';
        $hostEvent = '';
        $allocatedData = '';
        $incubatorData = '';
        $reserveTechData = '';
        $submitData = '';
        $generalData = '';
        $scheduleVisitDataget = $this->ReservationController->getUserActivity($request)->getData();
        if (property_exists($scheduleVisitDataget, 'data')) {
            $scheduleVisitData = $scheduleVisitDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $scheduleVisit = array_slice($scheduleVisitData, -2);
        }else{
            $scheduleVisit = '';
        }
        // dd($scheduleVisitData);
        // $scheduleVisit = array_slice($scheduleVisitData, -2);
        // dd($scheduleVisit);

        $request->merge(["request_type"=>'event']);
        $hostEventDataget = $this->ReservationController->getUserActivity($request)->getData();
        if (property_exists($hostEventDataget, 'data')) {
            $hostEventData = $hostEventDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $hostEvent = array_slice($hostEventData, -2);
        }else{
            $hostEvent = '';
        }


        $request->merge(["request_type"=>'resource']);
        $allocatedResourceDataget = $this->ReservationController->getUserActivity($request)->getData();
        if (property_exists($allocatedResourceDataget, 'data')) {
            $allocatedDataa = $allocatedResourceDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $allocatedData = array_slice($allocatedDataa, -2);
        }else{
            $allocatedData = '';
        }


        $request->merge(["request_type"=>'incubator']);
        $reserveIncubatorDataget = $this->ReservationController->getUserActivity($request)->getData();

        if (property_exists($reserveIncubatorDataget, 'data')) {
            $reserveIncubatorDataa = $reserveIncubatorDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $incubatorData = array_slice($reserveIncubatorDataa, -2);
        }else{
            $incubatorData = '';
        }

        // $incubatorData = array_slice($reserveIncubatorData, -2);

        $request->merge(["request_type"=>'workshop']);
        $reserveTechnologyDataget = $this->ReservationController->getUserActivity($request)->getData();
       
        if (property_exists($reserveTechnologyDataget, 'data')) {
            $reserveTechDataa = $reserveTechnologyDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $reserveTechData = array_slice($reserveTechDataa, -2);
        }else{
            $reserveTechData = '';
        }



        $request->merge(["request_type"=>'idea']);
        $submitIdeaDataget = $this->ReservationController->getUserActivity($request)->getData();

        if (property_exists($submitIdeaDataget, 'data')) {
            $submitDataa = $submitIdeaDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $submitData = array_slice($submitDataa, -2);
        }else{
            $submitData = '';
        }



        $request->merge(["request_type"=>'general']);
        $generalDataget = $this->ReservationController->getUserActivity($request)->getData();

        if (property_exists($generalDataget, 'data')) {
            $generalDataa = $generalDataget->data;
            // Process the data or do whatever you need with it
            // dd($scheduleVisitData);
            $generalData = array_slice($generalDataa, -2);
        }else{
            $generalData = '';
        }


        // dd($submitData);
        // $data = ['google_id' => 'zzzzzzzzzzzuuuuuzzzz','request_type' => 'event'];
        // $request = new Request();
        // $request->merge($data);
        // $response = $this->ReservationController->getUserActivity($google_id);
        // echo"<pre>";print_r($response->getData()->data); exit();

        return view('pages.web.services.my-activity',compact('scheduleVisit','hostEvent','allocatedData','incubatorData','reserveTechData','submitData','generalData'));
    }



    // public function submitIdea(){
    //     return view('pages.web.services.submit-idea');
    // }

// public function generalResrvation(){
    //     return view('pages.web.services.general-reservation');
    // }
    // public function reserveTech(){
    //     return view('pages.web.services.reserve-technology');
    // }
    public function reserveIncubator(){
        return view('pages.web.services.reserve-incubator');
    }

    public function getDeleteRequeste(Request $request){
        // dd($request->all());
        $google_id = Session('auth_google_id');

        $request->merge(["google_id"=>$google_id]);
        if($request->field2 == 'visit'){
            $response= $this->ReservationController->cancelVisitRequest($request)->getData();
        }else if($request->field2 == 'event'){
            $response= $this->ReservationController->cancelEventRequest($request)->getData();
        }else if($request->field2 == 'allocated'){
            $response= $this->ReservationController->cancelComputingResourceRequest($request)->getData();
        }else if($request->field2 == 'incubator'){
            $response= $this->ReservationController->cancelIncubatorRequest($request)->getData();
        }else if($request->field2 == 'reserveTech'){
            $response= $this->ReservationController->cancelWorkshopRequest($request)->getData();
        }else if($request->field2 == 'idea'){
            $response= $this->ReservationController->cancelIdeaRequest($request)->getData();
        }else if($request->field2 == 'general'){
            $response= $this->ReservationController->cancelGeneralReservationRequest($request)->getData();
        }
        if ($response->success==true) {
            // return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->message]);
            return response()->json(['status' => 'Success', 'msg'=> $response->message]);
        } else {
            // return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->message]);
            return response()->json(['status' => 'Success', 'msg'=> $response->message]);
        }
    }
}
