<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\general_reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class GeneralReservationRequest extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.General-reservation.list');
    }

    public function add()
    {
        return view('pages.admin.Services.General-reservation.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|date',
            'description' => 'required',
            'justification' => 'required'
        ]);

        try {
            $action = "";
            if ($request->reservation_id) {
                $general_request = general_reservation::find($request->reservation_id);
                $action = "updated";
            } else {
                $general_request = new general_reservation();
                $general_request->status_of_request = 'Approved';
                $action = "added";
            }

            $general_request->users_id = Auth::user()->id;
            $general_request->title = $request->title;
            $general_request->start_date = $request->start_date ?? "0000-00-00 00:00:00";
            $general_request->end_date = $request->end_date ?? "0000-00-00 00:00:00";
            $general_request->description = $request->description;
            $general_request->justification = $request->justification;
            $general_request->save();

            return back()->with(['success' => 'General reservation request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = general_reservation::leftJoin('users', 'users.id', '=', 'general_reservation.users_id')
                    ->select('general_reservation.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-general-reservation-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
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
            $getData = general_reservation::leftJoin('users', 'users.id', '=', 'general_reservation.users_id')
                ->select('general_reservation.*', 'users.first_name', 'users.last_name')->where('general_reservation.id', $id)->first();

            return view('pages.admin.Services.General-reservation.edit', ['data' => $getData]);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = general_reservation::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.General-reservation.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            general_reservation::where('id', $request->reservation_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'General reservation request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

}

