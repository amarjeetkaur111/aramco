<?php

namespace App\Http\Controllers\web\Services;
use App\Http\Controllers\Controller;
use App\Libraries\AvailableRoomApi;
use App\Libraries\AvailableSpaceApi;
use App\Models\Apis\incubator_request;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class ReserveIncubatorController extends Controller
{
    //
    private $ReservationController;
    private $availableRoomList;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
        $this->availableRoomList = new AvailableRoomApi();
    }

    public function reserveIncubator() {
        $available_room =  $this->incubatorAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Incubator');
        return view('pages.web.services.reserveIncubator.reserve-incubator', compact('available_room'));
    }

    public function reserveIncubatorStore(Request $request)
    {
        try {
            $rules['usecase_name'] = 'required';
            if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
                $rules['space_name'] = 'required';
            }
            $rules['start_date'] = 'required';
            $rules['end_date'] = 'required';
            $rules['contact_of_usecase'] = 'required';
            $rules['num_of_employees'] = 'required';
            $rules['justification'] = 'required';
            $rules['additional_info'] = 'required';

            $this->validate($request, $rules);

            $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date"));

            if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
                $check_event = $this->ReservationController->checkExistingIncubatorRequest($request);
                if (!$check_event->getData()->success) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $check_event->getData()->message]);
                }

                $availableSpaceList = new AvailableSpaceApi($request->space_name, $request->start_date, $request->end_date);
                $status_code =  $availableSpaceList->getSpace()['meta']['status_code'];

                if ($status_code == 200) {
                    if (!empty($availableSpaceList->getSpace()['data'])) {
                        return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Booking Already done for given space, date and time by below Incubator request']);
                    }
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $availableSpaceList->getSpace()['meta']['message']]);
                }
            }

            $response = $this->ReservationController->reserveIncubatorRequest($request);

            if($response->getData()->data){
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Incubator request has been submitted successfully']);
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
            }

        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
        }
    }

    public function reserveIncubatorList(Request $request)
    {
        // $getReserveIncubator = incubator_request::with('user')->orderBy('incubator_request.created_at', 'DESC')->paginate(10);
        $getReserveIncubator = incubator_request::with('user')->orderBy('incubator_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getReserveIncubator, 'type'=>'incubator', 'action' => 'services-admin-reserve-incubator-view'])->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.services.reserveIncubator.manage-reserve-incubator-list', ['lists' => $getReserveIncubator, 'type'=>'incubator', 'action' => 'services-admin-reserve-incubator-view']);
    }

    public function reserveIncubatorView(int $id)
    {
        $getReserveIncubator = incubator_request::with('user')->find($id);
        $available_room =  $this->incubatorAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Incubator');
        return view('pages.web.services.reserveIncubator.manage-reserve-incubator-form', compact('getReserveIncubator', 'available_room'));
    }

    public function reserveIncubatorChangeStatus(Request $request)
    {
        $this->validate($request, [
            'usecase_name' => 'required',
            'space_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contact_of_usecase' => 'required',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);
        try {
            if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
                $response = $this->ReservationController->ChangeReserveIncubatorRequestStatus($request);

                if ($response->getData()->success) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->msg ?? $response->getData()->message]);
                }
            }

            if ($request->status_of_request == "modify") {
                $check_event = $this->ReservationController->checkExistingIncubatorRequest($request);
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

                $response = $this->ReservationController->updateReserveIncubatorRequest($request);
                if($response->getData()->data) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }

            }

        }catch (\Exception $e) {
            //dd($e->getMessage(), $e->getFile(), $e->getLine());
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }


    public function incubatorAvailableRoom($main_array, $remove_value)
    {
        foreach ($main_array as $index => $value) {
            if (strpos(strtolower($value), strtolower($remove_value)) === false) {
                unset($main_array[$index]);
            }
        }
        return $main_array;
    }
    // My Incubator Functionalities
    public function getReserveIncubatorEvents(Request $request)
    {
        $users_id = Session('auth_userid');
        $getIncubatorEvent = incubator_request::where('users_id',$users_id)->orderBy('created_at', 'DESC')->paginate(10);
        // echo"<pre>";print_r($getHostedEvent);exit();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getIncubatorEvent,'type'=>'incubator', 'action' => 'services-my-reserve-incubator-events-edit', 'actionShow' => 'services-my-reserve-incubator-events-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.reserveIncubator.my-incubator-event-list', ['lists' => $getIncubatorEvent,'type'=>'incubator', 'action' => 'services-my-reserve-incubator-events-edit', 'actionShow' => 'services-my-reserve-incubator-events-show']);
    }

    public function editIncubatorVisits(int $id)
    {
        $getAllocatedRequest = incubator_request::with('user')->find($id);
        $showMode = false;
        $available_room =  $this->incubatorAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Incubator');
        if($getAllocatedRequest->users_id ==Auth::id())
        return view('pages.web.services.reserveIncubator.edit-reserve-incubator', compact('getAllocatedRequest','showMode', 'available_room'));
        else
        return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Unathourized Access']);;
    }

    public function showIncubatorVisits(int $id)
    {
        $getAllocatedRequest = incubator_request::with('user')->find($id);
        $showMode = true;
        $available_room =  $this->incubatorAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Incubator');
        if($getAllocatedRequest->users_id ==Auth::id())
        return view('pages.web.services.reserveIncubator.edit-reserve-incubator', compact('getAllocatedRequest','showMode', 'available_room'));
        else
        return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Unathourized Access']);;
    }

    public function editIncubatorPost(Request $request)
    {
        $rules['usecase_name'] = 'required';
        if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
            $rules['space_name'] = 'required';
        }
        $rules['start_date'] = 'required';
        $rules['end_date'] = 'required';
        $rules['contact_of_usecase'] = 'required';
        $rules['num_of_employees'] = 'required';
        $rules['justification'] = 'required';
        $rules['additional_info'] = 'required';

        $this->validate($request, $rules);

        if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
            $check_event = $this->ReservationController->checkExistingIncubatorRequest($request);
            if (!$check_event->getData()->success) {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $check_event->getData()->message]);
            }

            $availableSpaceList = new AvailableSpaceApi($request->space_name, $request->start_date, $request->end_date);
            $status_code = $availableSpaceList->getSpace()['meta']['status_code'];

            if ($status_code == 200) {
                if (!empty($availableSpaceList->getSpace()['data'])) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Booking Already done for given space, date and time by below Incubator request']);
                }
            } else {
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $availableSpaceList->getSpace()['meta']['message']]);
            }
        }

        $response = $this->ReservationController->updateReserveIncubatorRequest($request);

        if ($response->getData()->data)
            return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);


    }

    public function cancelReserveIncubatorList(Request $request)
    {
        $getReserveIncubator = incubator_request::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('incubator_request.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getReserveIncubator, 'action' => 'services-admin-cancel-reserve-incubator-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.reserveIncubator.manage-cancellation-reserve-incubator', ['lists' => $getReserveIncubator, 'action' => 'services-admin-cancel-reserve-incubator-view']);
    }

    public function cancelReserveIncubatorView(int $id)
    {
        $getReserveIncubator = incubator_request::with('user')->find($id);
        $showMode = true;
        $available_room =  $this->incubatorAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Incubator');
        return view('pages.web.services.reserveIncubator.manage-cancellation-reserve-incubator-form', compact('getReserveIncubator', 'showMode', 'available_room'));
    }

    public function cancelReserveIncubator(Request $request)
    {
        try {
            if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
                $response = $this->ReservationController->approveCancelIncubatorRequest($request);

                if ($response->getData()->success) {
                    return redirect()->route('services-admin-cancel-reserve-incubator-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->route('services-admin-cancel-reserve-incubator-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }
        } catch (\Exception $e){
            return redirect()->route('services-admin-cancel-reserve-incubator-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }
}
