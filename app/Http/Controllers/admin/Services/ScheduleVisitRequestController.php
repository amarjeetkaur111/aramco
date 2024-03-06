<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\schedule_visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Libraries\CommonFunction;

class ScheduleVisitRequestController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Visit-request.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Visit-request.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'visit_title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'num_of_visitors' => 'required',
            'visitor_coordinator_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            $action = "";
            if ($request->visit_id) {
                $visit_request = schedule_visit::find($request->visit_id);
                $action = "updated";
            } else {
                $visit_request = new schedule_visit();
                $visit_request->status_of_request = 'Approved';
                $action = "added";
            }

            $visit_request->visit_title = $request->visit_title;
            $visit_request->users_id = Auth::user()->id;
            $visit_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $visit_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $visit_request->num_of_visitors = $request->num_of_visitors;
            $visit_request->visitor_coordinator_contact = $request->visitor_coordinator_contact;
            $visit_request->justification = $request->justification;
            $visit_request->additional_info = $request->additional_info;
            $visit_request->save();

            return back()->with(['success' => 'Visit Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = schedule_visit::leftJoin('users', 'users.id', '=', 'schedule_visit_request.users_id')
                    ->select('schedule_visit_request.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-visit-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
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
            $getData = schedule_visit::leftJoin('users', 'users.id', '=', 'schedule_visit_request.users_id')
                ->select('schedule_visit_request.*', 'users.first_name', 'users.last_name')->where('schedule_visit_request.id', $id)->first();

            return view('pages.admin.Services.Visit-request.edit', ['data' => $getData]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try{
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = schedule_visit::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.Visit-request.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            schedule_visit::where('id', $request->visit_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'Request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }


}
