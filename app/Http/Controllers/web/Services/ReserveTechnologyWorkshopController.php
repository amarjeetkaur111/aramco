<?php

namespace App\Http\Controllers\web\Services;

use App\Http\Controllers\Controller;
use App\Libraries\AvailableRoomApi;
use App\Libraries\AvailableSpaceApi;
use App\Models\Apis\technology_workshop_request;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;
use Illuminate\Support\Arr;

class ReserveTechnologyWorkshopController extends Controller
{
    //
    private $ReservationController;
    private $availableRoomList;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
        $this->availableRoomList = new AvailableRoomApi();
    }

    public function reserveTech() {
        $available_room =  $this->workshopAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Workshop');
        return view('pages.web.services.reserveTech.reserve-technology', compact('available_room'));
    }

    public function reserveTechStore(Request $request)
    {
        $rules['workshop_name'] = 'required';
        if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
            $rules['space_name'] = 'required';
        }
        $rules['start_date'] = 'required';
        $rules['start_time'] = 'required';
        $rules['end_date'] = 'required';
        $rules['end_time'] = 'required';
        $rules['num_of_people'] = 'required';
        $rules['point_of_contact'] = 'required';
        $rules['justification'] = 'required';
        $rules['additional_info'] = 'required';

        $this->validate($request, $rules);

        try {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $request->start_date = date('Y-m-d H:i:s', strtotime("$start_date $request->start_time"));
            $request->end_date = date('Y-m-d H:i:s', strtotime("$end_date $request->end_time"));

            if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
                $check_event = $this->ReservationController->checkexistingworkshoprequest ($request);
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
            }

            $response = $this->ReservationController->technologyWorkshopRequest($request);
            if($response->getData()->data)
                return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' =>'Reserve Technology Workshop Request Submitted Successfully']);
            else
                return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
        }
    }

    public function reserveTechnologyList(Request $request)
    {
        // $getTechnology = technology_workshop_request::with('user')->orderBy('technology_workshop_request.created_at', 'DESC')->paginate(10);
        $getTechnology = technology_workshop_request::with('user')->orderBy('technology_workshop_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getTechnology, 'action' => 'services-admin-reserve-technology-view'])->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.services.reserveTech.manage-reserve-technology-list', ['lists' => $getTechnology, 'action' => 'services-admin-reserve-technology-view']);
    }

    public function reserveTechnologyView(int $id)
    {
        $resrveTech = technology_workshop_request::with('user')->find($id);
        $available_room =  $this->workshopAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Workshop');

        return view('pages.web.services.reserveTech.manage-reserve-technology-form',compact('resrveTech', 'available_room'));
    }

    public function reserveTechnologyChangeStatus(Request $request)
    {
        $this->validate($request, [
            'space_name' => 'required',
            'workshop_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'num_of_people' => 'required',
            'point_of_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
                $response = $this->ReservationController->ChangeTechnologyWorkshopRequestStatus($request);

                if ($response->getData()->success) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->msg ?? $response->getData()->message]);
                }
            }

            if ($request->status_of_request == "modify") {
                $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
                $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

                $check_event = $this->ReservationController->checkExistingWorkshopRequest($request);
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

                $response = $this->ReservationController->updateTechnologyWorkshopRequest($request);

                if($response->getData()->data)
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                else
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong!']);
        }
    }


    public function workshopAvailableRoom($main_array, $remove_value)
    {
        foreach ($main_array as $index => $value) {
            if (strpos(strtolower($value), strtolower($remove_value)) === false) {
                unset($main_array[$index]);
            }
        }
        return $main_array;
    }
    // My Reserve Tech Functionalities
    public function getReserveTechEvents(Request $request)
    {
        $users_id = Session('auth_userid');
        $getReserveTech = technology_workshop_request::where('users_id',$users_id)->orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getReserveTech, 'type'=>'reserveTech', 'action' => 'services-my-reserve-tech-events-edit', 'actionShow' => 'services-my-reserve-tech-events-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.reserveTech.my-reserveTech-event-list', ['lists' => $getReserveTech, 'type'=>'reserveTech', 'action' => 'services-my-reserve-tech-events-edit', 'actionShow' => 'services-my-reserve-tech-events-show']);
    }

    public function editReserveTechReq(int $id)
    {
        $resrveTech = technology_workshop_request::with('user')->find($id);
        $showMode = false;
        $available_room =  $this->workshopAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Workshop');
        return view('pages.web.services.reserveTech.edit-reserve-workshop',compact('resrveTech','showMode', 'available_room'));
    }

    public function showReserveTechReq(int $id)
    {
        $resrveTech = technology_workshop_request::with('user')->find($id);
        $showMode = true;
        $available_room =  $this->workshopAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Workshop');
        // dd($resrveTech);
        return view('pages.web.services.reserveTech.edit-reserve-workshop',compact('resrveTech','showMode', 'available_room'));
    }

    public function editReserveTechPost(Request $request)
    {
        $rules['workshop_name'] = 'required';
        if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
            $rules['space_name'] = 'required';
        }
        $rules['start_date'] = 'required';
        $rules['start_time'] = 'required';
        $rules['end_date'] = 'required';
        $rules['end_time'] = 'required';
        $rules['num_of_people'] = 'required';
        $rules['point_of_contact'] = 'required';
        $rules['justification'] = 'required';
        $rules['additional_info'] = 'required';

        $this->validate($request, $rules);

        $request->start_date = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time"));
        $request->end_date = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time"));

        if (in_array(auth()->user()->roles->first()->id, [1, 5])) {
            $check_event = $this->ReservationController->checkExistingWorkshopRequest($request);
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
        }

        $response = $this->ReservationController->updateTechnologyWorkshopRequest($request);

        if ($response->getData()->data)
            return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);

    }

    public function cancelReserveTechnologyList(Request $request)
    {
        $getAllocatedRequest = technology_workshop_request::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('technology_workshop_request.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-cancel-reserve-technology-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.reserveTech.manage-cancellation-reserved-technology-workshop', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-cancel-reserve-technology-view']);
    }

    public function cancelReserveTechnologyView(int $id)
    {
        $getReserveTech = technology_workshop_request::with('user')->find($id);
        $showMode = true;
        $available_room =  $this->workshopAvailableRoom(Arr::pluck($this->availableRoomList->getList()['data'], 'name', 'id'), 'Workshop');
        return view('pages.web.services.reserveTech.manage-cancellation-reserved-technology-workshop-form', compact('getReserveTech', 'showMode', 'available_room'));
    }

    public function cancelReserveTechnology(Request $request)
    {
        try {
            if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
                $response = $this->ReservationController->approveCancelWorkshopRequest($request);

                if ($response->getData()->success) {
                    return redirect()->route('services-admin-cancel-reserve-technology-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->route('services-admin-cancel-reserve-technology-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }
        } catch (\Exception $e){
            return redirect()->route('services-admin-cancel-reserve-technology-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }
}
