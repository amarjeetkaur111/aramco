<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\required_resource_list;
use DataTables;
use Illuminate\Http\Request;

class RequiredResourcesController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Required-resources.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Required-resources.add');
    }

    public function store(Request $request)
    {
        $rules['name'] = 'required|unique:required_resources_list';
        $this->validate($request, $rules);

        try {
        $action = "";
        if ($request->rr_id) {
            $required_resources = required_resource_list::find($request->rr_id);
            $action = 'updated';
        } else {
            $required_resources = new required_resource_list();
            $action = 'added';
        }

        $required_resources->name = $request->name;
        $required_resources->save();
        return back()->with(['success' => 'Required resources has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                return DataTables::eloquent(required_resource_list::select('*'))
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('admin-service-required-resources-edit',['id' => $row->id]).'" class="action-btn"><i class="fa fa-edit"></i></a>';
                        $btn .='<a href="#" onclick="deleteData('. $row->id. ')" class="action-btn delete"><i class="fa fa-trash-alt"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function edit(int $id)
    {
        try {
            $data = required_resource_list::find($id);
            return view('pages.admin.Services.Required-resources.edit', compact('data'));
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function delete(Request $request)
    {
        try {
            required_resource_list::where('id', $request->row_id)->delete();
            return response()->json(['status' => 'success']);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!']);
        }
    }
}

