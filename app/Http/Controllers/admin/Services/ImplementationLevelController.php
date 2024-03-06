<?php

namespace App\Http\Controllers\admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Apis\current_implementation_level;
use DataTables;
use Illuminate\Http\Request;

class ImplementationLevelController extends Controller
{
    public function index()
    {
        return view('pages.admin.Services.Implementation-level.list');
    }

    public function add()
    {
        return view('pages.admin.Services.Implementation-level.add');
    }

    public function store(Request $request)
    {
        $rules['name'] = 'required|unique:technology_list';
        $this->validate($request, $rules);

        try {
            $action = "";
            if ($request->level_id) {
                $implementation_level = current_implementation_level::find($request->level_id);
                $action = 'updated';
            } else {
                $implementation_level = new current_implementation_level();
                $action = 'added';
            }

            $implementation_level->name = $request->name;
            $implementation_level->save();
            return back()->with(['success' => 'Implementation level has been '.$action.' successfully']);
        }catch (\Exception $e){
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function getList(Request $request)
    {
        try {
            if($request->ajax()) {
                return DataTables::eloquent(current_implementation_level::select('*'))
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="'.route('admin-service-implementation-level-edit',['id' => $row->id]).'" class="action-btn"><i class="fa fa-edit"></i></a>';
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
            $data = current_implementation_level::find($id);
            return view('pages.admin.Services.Implementation-level.edit', compact('data'));
        }catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function delete(Request $request)
    {
        try {
            current_implementation_level::where('id', $request->row_id)->delete();
            return response()->json(['status' => 'success']);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!']);
        }
    }
}


