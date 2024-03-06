<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\technology_workshop_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class WorkshopRequestController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Workshop-request.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Workshop-request.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'workshop_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'num_of_people' => 'required',
            'point_of_contact' => 'required',
            'justification' => 'required',
            'additional_info' => 'required',
        ]);

        try {
            $action = "";
            if ($request->workshop_id) {
                $workshop_request = technology_workshop_request::find($request->workshop_id);
                $action = "updated";
            } else {
                $workshop_request = new technology_workshop_request();
                $workshop_request->status_of_request = 'Approved';
                $action = "added";
            }

            $workshop_request->workshop_name = $request->workshop_name;
            $workshop_request->users_id = Auth::user()->id;
            $workshop_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $workshop_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $workshop_request->num_of_people = $request->num_of_people;
            $workshop_request->point_of_contact = $request->point_of_contact;
            $workshop_request->justification = $request->justification;
            $workshop_request->additional_info = $request->additional_info;
            $workshop_request->save();

            return back()->with(['success' => 'Workshop Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = technology_workshop_request::leftJoin('users', 'users.id', '=', 'technology_workshop_request.users_id')
                    ->select('technology_workshop_request.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-workshop-request-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
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
            $getData = technology_workshop_request::leftJoin('users', 'users.id', '=', 'technology_workshop_request.users_id')
                ->select('technology_workshop_request.*', 'users.first_name', 'users.last_name')->where('technology_workshop_request.id', $id)->first();

            return view('pages.admin.Services.Workshop-request.edit', ['data' => $getData]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = technology_workshop_request::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.Workshop-request.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            technology_workshop_request::where('id', $request->workshop_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'Request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

}

