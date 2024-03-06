<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\computing_resources_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ResourceRequestController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Resources-request.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Resources-request.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'usecase_name' => 'required',
            'contact_of_usecase' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'num_of_employees' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            $action = "";
            if ($request->rr_id) {
                $resource_request = computing_resources_request::find($request->rr_id);
                $action = "updated";
            } else {
                $resource_request = new computing_resources_request();
                $resource_request->status_of_request = 'Approved';
                $action = "added";
            }

            $resource_request->usecase_name = $request->usecase_name;
            $resource_request->users_id = Auth::user()->id;
            $resource_request->contact_of_usecase = $request->contact_of_usecase;
            $resource_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $resource_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $resource_request->num_of_employees = $request->num_of_employees;
            $resource_request->justification = $request->justification;
            $resource_request->additional_info = $request->additional_info;
            $resource_request->save();

            return back()->with(['success' => 'Resource Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = computing_resources_request::leftJoin('users', 'users.id', '=', 'computing_resources_request.users_id')
                    ->select('computing_resources_request.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-resource-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
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
            $getData = computing_resources_request::leftJoin('users', 'users.id', '=', 'computing_resources_request.users_id')
                ->select('computing_resources_request.*', 'users.first_name', 'users.last_name')->where('computing_resources_request.id', $id)->first();

            return view('pages.admin.Services.Resources-request.edit', ['data' => $getData]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = computing_resources_request::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.Resources-request.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            computing_resources_request::where('id', $request->rr_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'Request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

}
