<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Apis\computing_resources_request;
use App\Models\Apis\current_implementation_level;
use App\Models\Apis\idea_request;
use App\Models\Apis\technology_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Storage;

class IdeaRequestController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Idea-request.list');
    }

    public function add()
    {
        $data['implementation_level'] = current_implementation_level::pluck('name', 'id');
        $data['technology'] = technology_list::pluck('name', 'id');

        return view('pages.admin.Services.Idea-request.add', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'track_channel' => 'required',
            'idea_name' => 'required',
            'idea_problem' => 'required',
            'idea_solution' => 'required',
            'idea_resource_requirement' => 'required',
            'contributors' => 'required',
            'point_of_contact' => 'required',
            'technology' => 'required',
            'attachment' => 'max:10240'
        ]);

        try {
            $action = "";
            if ($request->rr_id) {
                $idea_request = idea_request::find($request->rr_id);
                $action = "updated";
            } else {
                $idea_request = new idea_request();
                $idea_request->status_of_request = 'Approved';
                $action = "added";
            }

            $idea_request->track_channel = $request->track_channel;
            $idea_request->users_id = Auth::user()->id;
            $idea_request->idea_name = $request->idea_name;
            $idea_request->idea_problem = $request->idea_problem;
            $idea_request->idea_solution = $request->idea_solution;
            $idea_request->idea_resource_requirement = $request->idea_resource_requirement;
            $idea_request->contributors = $request->contributors;
            $idea_request->point_of_contact = $request->point_of_contact;
            $idea_request->current_implementation_level = $request->current_implementation_level;
            $idea_request->technology = $request->technology;
            $idea_request->other_technology = $request->other_technology;

            if ($request->has('attachment')) {
                if (env('STORAGE') == "local") {
                    $file = $request->attachment;
                    $filename = str_replace('.', '-', $request->idea_name) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->attachment->getClientOriginalExtension();
                    $file->storeAs('ideaAttachments', $filename, ['disk' => 'my_files']);
                    $idea_request->attachment = env('ASSET_URL') . '/uploads/ideaAttachments/' . $filename;;
                }

                if (env('STORAGE') == "s3") {
                    $filee = $request->attachment;
                    $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();
                    $path = Storage::disk('s3')->putFileAs('', $request->attachment, "ideaAttachments/" . $filename, 'public');
                    $idea_request->attachment = config('filesystems.disks.s3.url') . '/' . $path;
                }
            }
            $idea_request->save();

            return back()->with(['success' => 'Resource Request has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = idea_request::leftJoin('users', 'users.id', '=', 'idea_request.users_id')
                    ->select('idea_request.*', 'users.first_name', 'users.last_name');

                return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return CommonFunction::statusWiseBadge($row->status_of_request);
                    })
                    ->editColumn('current_implementation_level', function($row){
                        return CommonFunction::getImplementationLevel($row->current_implementation_level);
                    })
                    ->editColumn('technology', function($row){
                        return CommonFunction::getTechnology($row->current_implementation_level);
                    })
                    ->addColumn('action', function($row){
                        return '<a href="'.route('admin-service-idea-request-view',['id' => $row->id]).'" class="action-btn"><i class="fa fa-eye"></i></a>';
                    })
                    ->rawColumns(['action', 'status','current_implementation_level','technology'])
                    ->make(true);
            }
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function action(int $id)
    {
        // dd($id);
        try {
            // $getData = idea_request::leftJoin('users', 'users.id', '=', 'idea_request.users_id')
            //     ->select('idea_request.*', 'users.first_name', 'users.last_name')->where('idea_request.id', $id)->first();
            $implementation_level = current_implementation_level::pluck('name', 'id');
            // dd($implementation_level);
            $technology = technology_list::pluck('name', 'id');
                $getData = idea_request::with(['user','implementation_level','technology'])->where('id',$id)->first();
            // dd($getData->toArray());
            return view('pages.admin.Services.Idea-request.edit', compact('implementation_level','technology','getData'));
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatus(int $id)
    {
        try {
            $data['status'] = CommonFunction::getStatus();
            $data['id'] = $id;
            $data['selected_status'] = idea_request::where('id', $id)->value('status_of_request');

            return view('pages.admin.Services.Resources-request.change-status', $data);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function changeStatusUpdate(Request $request)
    {
        try {
            idea_request::where('id', $request->rr_id)->update(['status_of_request' => $request->status]);
            return back()->with(['success' => 'Request status has been updated successfully']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

}

