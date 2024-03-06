<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Role::select('*');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('admin-roles-add',['id' => $row->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.admin.roles.index');
    }

    public function add($id = null)
    {
        $data = null;
        $action = route('admin-roles-store');
        $add = 'Add';
        $permissions = Permission::get();
        if($id){
            $data = Role::with('permissions')->find($id);
            $action = route('admin-roles-store',['id' => $id]);
            $add = 'Edit';
        }
        return view('pages.admin.roles.add',compact('data','action','add','permissions'));
    }

    public function store(Request $request,$id = null)
    {
        $add = 'Add';
        $role = new Role;
        if ($id) {
            $add = 'Edit';
            $role = Role::find($id);
        }
        if ($id) {

            $this->validate($request, [
                'name' => 'required|unique:roles,id,' . $id,
                // 'permissions' => 'required',
            ]);
        } else {

            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                // 'permissions' => 'required',
            ]);
        }
        $role->name = $request->input('name');
        $role->save();
        // $role->syncPermissions($request->input('permissions'));
        return redirect()->route('admin-roles-index')->with(['status' => 'Success', 'class' => 'success', 'msg' => "{$add}ed Successfully!"]);
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
