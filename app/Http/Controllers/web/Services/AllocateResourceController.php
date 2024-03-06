<?php

namespace App\Http\Controllers\web\Services;
use App\Http\Controllers\Controller;
use App\Models\Apis\computing_resources_request;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\Apis\ReservationController;

class AllocateResourceController extends Controller
{
    //
    private $ReservationController;
    public function __construct()
    {
        $this->ReservationController = new ReservationController();
    }

    public function allocateResource(){
        return view('pages.web.services.allocateResource.allocate-resources');
    }

    public function allocateResourceStore(Request $request)
    {
        $this->validate($request, [
            'usecase_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contact_of_usecase' => 'required',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required'
        ]);

        $request->start_date = date('Y-m-d', strtotime("$request->start_date"));
        $request->end_date = date('Y-m-d', strtotime("$request->end_date"));

        $response = $this->ReservationController->computingResourcesRequest($request);

        if($response->getData()->data)
            return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Computing request has been submitted successfully']);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' =>'Something Went Wrong!']);
    }

    public function allocateResourceList(Request $request)
    {
        $getAllocatedRequest = computing_resources_request::with('user')->orderBy('computing_resources_request.created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-data', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-allocate-resources-view'])->render();
            return response()->json(['html' => $view]);
        }
        return view('pages.web.services.allocateResource.manage-allocated-resources-list', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-allocate-resources-view']);
    }

    public function allocateResourceView(int $id)
    {
        $getComputingRequest = computing_resources_request::with('user')->find($id);
        return view('pages.web.services.allocateResource.manage-allocated-resources-form',compact('getComputingRequest'));
    }

    public function allocateResourceChangeStatus(Request $request)
    {
        $this->validate($request, [
            'usecase_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            // 'end_time' => 'required',
            'contact_of_usecase' => 'required',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

            if ($request->status_of_request == "Approved" || $request->status_of_request == "Rejected") {
                $response = $this->ReservationController->ChangeComputingResourceRequestStatus($request);

                if ($response->getData()->success) {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }

            if ($request->status_of_request == "modify") {
                $response = $this->ReservationController->updateComputingResourceRequest($request);

                if($response->getData()->data)
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                else
                    return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
            }

    }

    // My Computing Functionalities
    public function getUserComputingEvents(Request $request)
    {
        $users_id = Session('auth_userid');
        // $getComputingEvent = computing_resources_request::where('users_id',$users_id)->orderBy('created_at', 'DESC')->paginate(10);
        $getComputingEvent = computing_resources_request::where('users_id',$users_id)->orderBy('created_at', 'DESC')->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-my-data', ['lists' => $getComputingEvent,  'type'=>'allocated', 'action' => 'services-my-alocating-computing-events-edit', 'actionShow' => 'services-my-alocating-computing-events-show'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.allocateResource.my-computing-event-list', ['lists' => $getComputingEvent, 'type'=>'allocated',  'action' => 'services-my-alocating-computing-events-edit', 'actionShow' => 'services-my-alocating-computing-events-show']);
    }

    public function editComputingVisits(int $id)
    {
        $getComputingRequest = computing_resources_request::with('user')->find($id);
        $showMode = false;
        return view('pages.web.services.allocateResource.edit-allocate-resources',compact('getComputingRequest','showMode'));
    }
    public function showComputingVisits(int $id)
    {
        $getComputingRequest = computing_resources_request::with('user')->find($id);
        $showMode = true;
        return view('pages.web.services.allocateResource.edit-allocate-resources',compact('getComputingRequest','showMode'));
    }

    public function editAllocatedVisitPost(Request $request)
    {

        $this->validate($request, [
            'usecase_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contact_of_usecase' => 'required',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        $response = $this->ReservationController->updateComputingResourceRequest($request);

        if ($response->getData()->data)
            return redirect()->route('my-activity')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
        else
            return redirect()->back()->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);


    }

    public function cancelAllocateResourceList(Request $request)
    {
        $getAllocatedRequest = computing_resources_request::with('user')
            ->where('is_approval_needed',1)
            ->where('is_cancellation_approved','Pending')
            ->orderBy('computing_resources_request.created_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            $view = view('pages.web.services.load-cancellation-data', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-cancel-allocate-resources-view'])->render();
            return response()->json(['html' => $view]);
        }

        return view('pages.web.services.allocateResource.manage-cancellation-allocate-resources', ['lists' => $getAllocatedRequest, 'action' => 'services-admin-cancel-allocate-resources-view']);
    }

    public function cancelAllocateResourceView(int $id)
    {
        $getComputingRequest = computing_resources_request::with('user')->find($id);
        $showMode = true;
        return view('pages.web.services.allocateResource.manage-cancellation-allocate-resources-form', compact('showMode', 'getComputingRequest'));
    }

    public function cancelAllocateResource(Request $request)
    {
        try {
            if ($request->cancellation_request == "Approved" || $request->cancellation_request == "Rejected") {
                $response = $this->ReservationController->approveCancelComputingResourceRequest($request);

                if ($response->getData()->success) {
                    return redirect()->route('services-admin-cancel-allocate-resources-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => $response->getData()->message]);
                } else {
                    return redirect()->route('services-admin-cancel-allocate-resources-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => $response->getData()->message]);
                }
            }
        } catch (\Exception $e){
            return redirect()->route('services-admin-cancel-allocate-resources-list')->with(['status' => 'Success', 'class' => 'warning', 'msg' => 'Something went wrong']);
        }
    }
}
