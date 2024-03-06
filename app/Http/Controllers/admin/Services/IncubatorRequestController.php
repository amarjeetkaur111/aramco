<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\incubator_request;
use App\Libraries\CommonFunction;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class IncubatorRequestController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = incubator_request::with('user')->select('*');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return CommonFunction::statusWiseBadge($row->status_of_request);
                })
                ->editColumn('users_id', function($row){
                    return $row->user->first_name;
                })
                ->addColumn('action', function($row){
                    return '<a href="'.route('admin-service-incubator-request-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['action', 'status','user_id'])
                ->make(true);
        }
        return view('pages.admin.Services.Incubator_Request.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Incubator_Request.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'usecase_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'contact_of_usecase' => 'required',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            $action = "";
            if ($request->incubator_id) {
                $incubator_request = incubator_request::find($request->incubator_id);
                $action = "updated";
            } else {
                $incubator_request = new incubator_request();
                $incubator_request->status_of_request = 'Approved';
                $action = "added";
            }

            $incubator_request->usecase_name = $request->usecase_name;
            $incubator_request->users_id = Auth::user()->id;
            $incubator_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $incubator_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $incubator_request->num_of_employees = $request->num_of_employees;
            $incubator_request->contact_of_usecase = $request->contact_of_usecase;
            $incubator_request->justification = $request->justification;
            $incubator_request->additional_info = $request->additional_info;
            $incubator_request->save();

            return back()->with(['success' => 'Incubator Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function action(int $id)
    {
        try {
            $getData = incubator_request::leftJoin('users', 'users.id', '=', 'incubator_request.users_id')
                ->select('incubator_request.*', 'users.first_name', 'users.last_name')->where('incubator_request.id', $id)->first();

            return view('pages.admin.Services.Incubator_Request.edit', ['data' => $getData]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = incubator_request::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.General-reservation.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            incubator_request::where('id', $request->incubator_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'Incubator reservation request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

}
