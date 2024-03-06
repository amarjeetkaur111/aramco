<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\technology_list;
use DataTables;
use Illuminate\Http\Request;

class IdeaRequestTechnologyController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Technology.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Technology.add');
    }

    public function store(Request $request)
    {
        $rules['name'] = 'required|unique:technology_list';
        $this->validate($request, $rules);

        try {
            $action = "";
            if ($request->technology_id) {
                $technology = technology_list::find($request->technology_id);
                $action = 'updated';
            } else {
                $technology = new technology_list();
                $action = 'added';
            }

            $technology->name = $request->name;
            $technology->save();
            return back()->with(['success' => 'Technology has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                return DataTables::eloquent(technology_list::select('*'))
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('admin-service-technology-edit',['id' => $row->id]).'" class="action-btn"><i class="fa fa-edit"></i></a>';
                        $btn .='<a href="#" onclick="deleteData('. $row->id. ')" class="action-btn delete"><i class="fa fa-trash-alt"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function edit(int $id)
    {
        try {
            $data = technology_list::find($id);
            return view('pages.admin.Services.Technology.edit', compact('data'));
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function delete(Request $request)
    {
        try {
            technology_list::where('id', $request->row_id)->delete();
            return response()->json(['status' => 'success']);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!']);
        }
    }
}


