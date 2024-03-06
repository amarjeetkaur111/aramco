<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\event_request;
use App\Models\Apis\required_resource_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class EventRequestController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Event-request.list');
    }

    public function add()
    {
        $required_request = required_resource_list::get(['id', 'name']);
        return view('pages.admin.Services.Event-request.add', compact('required_request'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'space_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'num_of_attendees' => 'required',
            'coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            if (!$request->event_id) {
                $isAvailableSpaceHere = $this->availableSpaceCheck(date('Y-m-d H:i:s', strtotime($request->start_date)), date('Y-m-d H:i:s', strtotime($request->end_date)), $request->space_name);

                if (!$isAvailableSpaceHere) {
                    return back()->with(['error' => 'Booking Already done for given space, date and time by below event']);
                }
            }

            $action = "";
            if ($request->event_id) {
                $event_request = event_request::find($request->event_id);
                $action = "updated";
            } else {
                $event_request = new event_request();
                $event_request->status_of_request = 'Approved';
                $action = "added";
            }

            $event_request->event_name = $request->event_name;
            $event_request->space_name = $request->space_name;
            $event_request->users_id = Auth::user()->id;
            $event_request->required_resources = implode(',', $request->required_resources);
            $event_request->other_required_resource = $request->other_required_resource ?? null;
            $event_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $event_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $event_request->num_of_attendees = $request->num_of_attendees;
            $event_request->coordinator_contact = $request->coordinator_contact;
            $event_request->justification = $request->justification;
            $event_request->additional_info = $request->additional_info;
            $event_request->save();

            return back()->with(['success' => 'Event Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = event_request::leftJoin('users', 'users.id', '=', 'event_request.users_id')->select('event_request.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-event-request-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function action(int $id)
    {
        try {
            $getData = event_request::leftJoin('users', 'users.id', '=', 'event_request.users_id')
                ->select('event_request.*', 'users.first_name', 'users.last_name')->where('event_request.id', $id)->first();
            $required_request = required_resource_list::get(['id', 'name']);

            return view('pages.admin.Services.Event-request.edit', ['data' => $getData, 'required_request' => $required_request]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();

            $data['id'] = $id;
            $data['selected_status'] = event_request::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.Event-request.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            event_request::where('id', $request->event_id)->update(['status_of_request' => $request->status]);

            return back()->with(['success' => 'Event status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function availableSpaceCheck($startdate, $enddate, $space_name)
    {
        $event = event_request::where('space_name', $space_name)
            ->where(function($query) use($startdate, $enddate){
                $query->where('start_date','>=',$startdate)
                    ->where('start_date','<=',$enddate);
            })
            ->orWhere(function($query) use($startdate, $enddate){
                $query->where('end_date','>=',$startdate)
                    ->where('end_date','<=',$enddate);
            })
            ->orWhere(function($query) use($startdate, $enddate){
                $query->where('start_date','<=',$startdate)
                    ->where('end_date','>=',$enddate);
            })
            ->orWhere(function($query) use($startdate, $enddate){
                $query->where('start_date','=',$startdate)
                    ->where('end_date','=',$enddate);
            })
            ->where(function($query){
                $query->where('status_of_request', 'Approved')
                    ->orWhere('status_of_request', 'Pending');
            })->get()->toArray();

        if(count($event) > 0) {
            return false;
        }

        return true;
    }

}

