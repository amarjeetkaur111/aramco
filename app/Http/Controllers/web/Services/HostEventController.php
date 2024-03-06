<?php

namespace App\Http\Controllers\web\Services;
use App\Http\Controllers\Controller;
use App\Libraries\AvailableRoomApi;
use App\Libraries\AvailableSpaceApi;
use App\Models\Apis\event_request;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;
use Illuminate\Support\Arr;

class HostEventController extends Controller
{
    //
    private $ReservationController;
    private $availableRoomList;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
        $this->availableRoomList = new AvailableRoomApi();
    }

    public function hostEvent(){

        $required_request = $this->ReservationController->getAllRequiredResourcesList(new Request())->getData()->data;
        $available_room =  $this->removeValueFromArray(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), ['Incubator', 'male', 'female', 'Workshop']);

        return view('pages.web.services.HostEvent.host-event', compact('required_request', 'available_room'));
    }

    public function hostEventStore(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'space_name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'num_of_attendees' => 'required',
            'coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
            'required_resources' => 'required',
            'other_required_resource' => 'required _if:required_required_resources.*,in:6',
        ]);

        try {
            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

            //checking available space in our server
            $check_event = $this->ReservationController->checkExcitingEvent($request);

            if (!$check_event->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $check_event->getData()->message]);
            }

            //checking available space in robin API
            $availableSpaceList = new AvailableSpaceApi($request->space_name, $request->start_date, $request->end_date);

            if ($availableSpaceList->getSpace()['meta']['status_code'] == 200) {
                if (!empty($availableSpaceList->getSpace()['data'])) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Booking Already done for given space, date and time by below Incubator request']);
                }
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $availableSpaceList->getSpace()['meta']['message']]);
            }


            $request->required_resources = implode(',', $request->required_resources);

            $response = $this->ReservationController->hostEventRequest($request);

            if($response->getData()->data) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Event request has been submitted successfully']);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
            }
        }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
        }

    }

    public function hostedEventList(Request $request)
    {
        $getHostedEvent = event_request::with('user')->orderBy('event_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getHostedEvent, 'action' => 'services-admin-hosted-event-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.HostEvent.manage-hosted-event-list', ['lists' => $getHostedEvent, 'action' => 'services-admin-hosted-event-view']);
    }

    public function hostedEventView(int $id)
    {
        $getHostedEvent = event_request::with('user')->find($id);
        $required_request = $this->ReservationController->getAllRequiredResourcesList(new Request())->getData()->data;
        $available_room =  $this->removeValueFromArray(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), ['Incubator', 'male', 'female', 'Workshop']);

        return view('pages.web.services.HostEvent.manage-service-hosted-event-form', compact('getHostedEvent', 'required_request', 'available_room'));
    }

    public function hostedEventChangeStatus(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'space_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_attendees' => 'required',
            'coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
            // 'feedback' => 'required',
            'required_resources' => 'required',
            'other_required_resource' => 'required _if:required_required_resources.*,in:6',

        ]);

        try {
            if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
                $response = $this->ReservationController->ChangeEventRequestStatus($request);
                if ($response->getData()->success) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                }
                else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->msg ?? $response->getData()->message]);
                }
            }

            if ($request->status_of_request == "modify") {
                $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
                $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

                $get_event = event_request::find($request->event_id);
                if ($get_event->space_name != $request->space_name || $get_event->start_date != $request->start_date || $get_event->end_date != $request->end_date) {
                    $check_event = $this->ReservationController->checkExcitingEvent($request);
                    if (!$check_event->getData()->success) {
                        return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $check_event->getData()->message]);
                    }
                }

                $availableSpaceList = new AvailableSpaceApi($request->space_name, $request->start_date, $request->end_date);
                if ($availableSpaceList->getSpace()['meta']['status_code'] == 200) {
                    if (!empty($availableSpaceList->getSpace()['data'])) {
                        return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Booking Already done for given space, date and time by below Incubator request']);
                    }
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $availableSpaceList->getSpace()['meta']['message']]);
                }

                if($request->required_resources && count($request->required_resources)>0)
                    $request->required_resources = implode(",",$request->required_resources);
                else
                    $request->required_resources = array();


                $response = $this->ReservationController->updateEventRequest($request);

                if($response->getData()->data)
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                else
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }

    // My Activity Functionalities
    public function getUserHostedEvents(Request $request)
    {
        $users_id = Session('auth_userid');
        // $getHostedEvent = event_request::where('users_id',$users_id)->orderBy('event_request.created_at', 'DESC')->paginate(10);
        $getHostedEvent = event_request::where('users_id',$users_id)->orderBy('event_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getHostedEvent, 'type'=>'event', 'action' => 'services-my-hosted-events-edit', 'actionShow' => 'services-my-hosted-events-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.HostEvent.my-hosted-event-list', ['lists' => $getHostedEvent, 'type'=>'event', 'action' => 'services-my-hosted-events-edit', 'actionShow' => 'services-my-hosted-events-show']);
    }
    public function editHostVisits($id){

        $getHostedEvent = event_request::with('user')->find($id);
        $showMode = false;
        $required_request = $this->ReservationController->getAllRequiredResourcesList(new Request())->getData()->data;
        $available_room =  $this->removeValueFromArray(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), ['Incubator', 'male', 'female', 'Workshop']);

        return view('pages.web.services.HostEvent.edit-host-event',compact('getHostedEvent','required_request','showMode', 'available_room'));
    }
    public function showHostVisits($id){

        $getHostedEvent = event_request::with('user')->find($id);
        $showMode = true;
        $required_request = $this->ReservationController->getAllRequiredResourcesList(new Request())->getData()->data;
        $available_room =  $this->removeValueFromArray(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), ['Incubator', 'male', 'female', 'Workshop']);
        return view('pages.web.services.HostEvent.edit-host-event',compact('getHostedEvent','required_request','showMode','available_room'));
    }

    public function editHostVisitsPost(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_attendees' => 'required',
            'coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
            'required_resources' => 'required',
            'other_required_resource' => 'required _if:required_required_resources.*,in:6',

        ]);

        try {
            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

            $check_event = $this->ReservationController->checkExcitingEvent($request);
            if (!$check_event->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $check_event->getData()->message]);
            }

            $availableSpaceList = new AvailableSpaceApi($request->space_name, $request->start_date, $request->end_date);
            if ($availableSpaceList->getSpace()['meta']['status_code'] == 200) {
                if (!empty($availableSpaceList->getSpace()['data'])) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Booking Already done for given space, date and time by below Incubator request']);
                }
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $availableSpaceList->getSpace()['meta']['message']]);
            }


            if($request->required_resources && count($request->required_resources)>0)
                $request->required_resources = implode(",",$request->required_resources);
            else
                $request->required_resources = array();

            $response = $this->ReservationController->updateEventRequest($request);

            if($response->getData()->data)
                return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
        }catch (\Exception $e){
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
        }
    }

    public function cancelHostedEventList(Request $request)
    {
        $getHostedEvent = event_request::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('event_request.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getHostedEvent, 'action' => 'services-admin-cancel-hosted-event-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.HostEvent.manage-cancellation-host-event', ['lists' => $getHostedEvent, 'action' => 'services-admin-cancel-hosted-event-view']);
    }

    public function cancelHostedEventView(int $id)
    {
        $getHostedEvent = event_request::with('user')->find($id);
        $showMode = false;
        $required_request = $this->ReservationController->getAllRequiredResourcesList(new Request())->getData()->data;
        $available_room =  $this->removeValueFromArray(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), ['Incubator', 'male', 'female', 'Workshop']);

        return view('pages.web.services.HostEvent.manage-cancellation-host-event-form',compact('getHostedEvent','showMode', 'required_request', 'available_room'));
    }

    public function removeValueFromArray($main_array, $remove_value)
    {
        foreach ($main_array as $index => $value) {
            foreach ($remove_value as $remove) {
                if (strpos(strtolower($value), strtolower($remove)) !== false) {
                    unset($main_array[$index]);
                }
            }
        }
        return $main_array;
    }

    public function cancelHostedEvent(Request $request)
    {
        if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
            $response = $this->ReservationController->approveCancelEventRequest($request);

            if ($response->getData()->success) {
                return redirect()->route('services-admin-cancel-hosted-event-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
            } else {
                return redirect()->route('services-admin-cancel-hosted-event-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        }

    }
}
