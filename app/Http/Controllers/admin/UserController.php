<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use Illuminate\Http\Request;
use App\Models\Apis\User;
use App\Models\Apis\profile_completion_requests;
use App\Models\UserDetail;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash;
use Illuminate\Support\Arr;
use DataTables;
use Auth;
use Session;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::select('*');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        if($row->first_name && $row->last_name)
                            return $row->first_name.' '.$row->last_name;
                        else
                            return '';
                    })
                    ->addColumn('dob', function($row){
                        return date('d M,Y',strtotime($row->dob));
                    })
                    ->addColumn('status', function($row){
                        if($row->status == 'Approved')
                            return "<span class='badge bg-success'>Approved</span>";
                        elseif($row->status == 'Rejected')
                            return "<span class='badge bg-warning'>Rejected</span>";
                        elseif($row->status == 'Pending')
                            return "<span class='badge bg-primary'>Pending Approval</span>";
                        else
                            return "<span class='badge bg-secondary'>Profile Not Completed</span>";

                    })
                    ->addColumn('role', function($row){
                        if($row->roles->first()->id == 1)
                            return "<span class='badge bg-danger p-2' style='font-size:11px;'>".$row->roles->first()->name."</span>";
                        elseif($row->roles->first()->id == 4)
                            return "<span class='badge bg-success p-2' style='font-size:11px;'>".$row->roles->first()->name."</span>";
                        elseif($row->roles->first()->id == 3)
                            return "<span class='badge bg-info p-2' style='font-size:11px;'>".$row->roles->first()->name."</span>";
                        elseif($row->roles->first()->id == 5)
                            return "<span class='badge bg-secondary p-2' style='font-size:11px;'>".$row->roles->first()->name."</span>";
                        else
                            return "<span class='badge bg-info p-2' style='font-size:11px;'>Limited User</span>";
                    })
                    ->addColumn('action', function($row){
                        if(Auth::user()->id == $row->id)
                           $btn = '<div class="actionelementsdiv"><a href="'.route('admin-users-add',['id' => $row->id]).'" class="table-action-link"><i class="fas fa-edit"></i></a>';
                        else
                        $btn = '<a href="'.route('admin-users-view',['id' => $row->id]).'" class="table-action-link"><i class="fas fa-search"></i></a></div>';
                            return $btn;
                    })
                    ->rawColumns(['action','name','dob','status','role'])
                    ->make(true);
        }
        return view('pages.admin.users.index');
    }

    public function pendingIndex(Request $request)
    {
        if($request->ajax()){
            $data = profile_completion_requests::select('*')->orderBy('id','DESC');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return $row->first_name.' '.$row->last_name;
                    })
                    ->addColumn('dob', function($row){
                        return date('d M,Y',strtotime($row->dob));
                    })
                    ->addColumn('status', function($row){
                        if($row->status == 'Approved')
                            return "<span class='badge bg-success'>Approved</span>";
                        elseif($row->status == 'Rejected')
                            return "<span class='badge bg-warning'>Rejected</span>";
                        else
                            return $row->status;

                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('admin-users-pending-add',['id' => $row->id]).'" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action','name','dob','status'])
                    ->make(true);
        }
        return view('pages.admin.users.pendingIndex');
    }

    public function pendingAdd($id)
    {
        // dd(Auth::user()->roles->first()->name);
        $data = null;
        if ($id) {
            $data = profile_completion_requests::find($id);
        }
        // echo"<pre>";print_r($data);exit();
        return view('pages.admin.users.pendingAdd', compact('data','id'));
    }

    public function approval($id)
    {
        $status = profile_completion_requests::find($id);
        $status =  $status->status;
        $action = route('admin-users-approvalPost', ['id' => $id]);
        return view('pages.admin.users.approval', compact('action','status','id'))->render();
    }

    public function approvalPost(Request $request, $id = null)
    {
        // echo"<pre>";print_r($request->all());exit();
        $data = profile_completion_requests::find($id);
        $user_id = $data->users_id;
        if($request->status == 'Approved')
        {
            $userarray = array(
                'profile_photo' => $data->profile_photo,
                'dob' => $data->dob,
                'gender' => $data->gender,
                'nationality' => $data->nationality,
                'job_experience' => $data->job_experience,
                'phone' => $data->phone,
                'twitter_account' => $data->twitter_account,
                'linkedin_account' => $data->linkedin_account,
                'status' => $request->status,
            );
            $approvedUser = User::find($user_id);
            $approvedUser->update($userarray);
            $role = Role::where('id',4)->first();
            $approvedUser->assignRole($role);
        }
        $data->status = $request->status;
        $data->save();
        return view('pages.admin.users.pendingAdd', compact('data','id'));
    }

    public function add($id = null)
    {
        // dd(Auth::user()->roles->first()->name);
        $data = null;
        $action = route('admin-users-store');
        $add = 'Add';
        $roles = Role::get();
        if ($id) {
            $data = User::with('roles')->find($id);
            $action = route('admin-users-store', ['id' => $id]);
            $add = 'Edit';
        }

        $countries = DB::table('countries')->select('name')->get();
        // echo"<pre>";print_r($data);exit();
        return view('pages.admin.users.add', compact('data', 'action', 'add','roles', 'countries'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request, $id = null)
    {
        // echo"<pre>";print_r($id);exit();
        if($id)
        {
            // $user = profile_completion_requests::where('users_id',$id)->first();
            $user = User::find($id);
            if($user)
            {
                $request->validate([
                    'name' => 'required',
                    // 'id' => 'required',
                    'dob' => 'required',
                    'gender' => 'required',
                    'nationality' => 'required',
                    'profile_photo' => 'max:800|mimes:jpg,gif,png',
                    'phone' => 'required|unique:profile_completion_requests,phone,' . $user->id,
                    'email' => 'required|unique:profile_completion_requests,email,' . $user->id,
                ]);
            }
            // else{
            //     $this->validate($request, [
            //         'name' => 'required',
            //         // 'id' => 'required',
            //         'dob' => 'required',
            //         'gender' => 'required',
            //         'nationality' => 'required',
            //         'profile_photo' => 'required',
            //         'phone' => 'required|unique:profile_completion_requests,phone',
            //         'email' => 'required|unique:profile_completion_requests,email',
            //     ]);
            //     $user = new profile_completion_requests;
            //     $user->users_id = $id;
            // }
        // }
        // else
        // {
        //     $this->validate($request, [
        //         'name' => 'required',
        //         // 'id' => 'required',
        //         'dob' => 'required',
        //         'gender' => 'required',
        //         'nationality' => 'required',
        //         'profile_photo' => 'required',
        //         'phone' => 'required|unique:profile_completion_requests,phone',
        //         'email' => 'required|unique:profile_completion_requests,email',
        //     ]);
        //     $user = new User;
        } else {
            $request->validate([
                 'profile_photo' => 'max:800|mimes:jpg,gif,png',
            ]);
        }
        $name = explode(' ',$request->name,2);
        $user->first_name = $name[0];
        $user->last_name = $name[1] ?? '';
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->nationality = $request->nationality;
        $user->phone = $request->phone;
        $user->job_experience = $request->job_experience;
        $user->dob = date('Y-m-d',strtotime($request->dob));

        if ($request->has('profile_photo')) {
            $file_path = "";
            if (env('STORAGE') == "local") {
                $file = $request->profile_photo;
                $filename = str_replace('.', '-', $request->email) . '-' . now()->format('d-m-Y-H-i-s') . '.' . $request->profile_photo->getClientOriginalExtension();
                $fileup = $file->storeAs('profilephotos', $filename, ['disk' => 'my_files']);
                $file_path = env('ASSET_URL') . '/uploads/profilephotos/' . $filename;
            }
            if (env('STORAGE') == "s3") {
                $filee = $request->profile_photo;
                $filename = time() . rand() . '.' . $filee->getClientOriginalExtension();

                $path = Storage::disk('s3')->putFileAs('', $request->profile_photo, "mosaic_wall/" . $filename, 'public');
                $file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }
            $user->profile_photo = $file_path;
            //put user profile image
            Session::put('profile_img', $file_path);
        }



        $user->save();
        // echo"<pre>";print_r($data);exit();
        return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => "Profile Updated Successfully!"]);

    }

    // public function destroy($id)
    // {
    //     User::find($id)->delete();
    //     return redirect()->route('admin-users.index')
    //                     ->with('success','User deleted successfully');
    // }

    // public function profile($id)
    // {
    //     $data = User::with('details')->find($id);
    //     $action = route('admin-users-updateprofile');
    //     $add = 'Edit';
    //     // echo"<pre>";print_r($data->toArray());exit();
    //     if($data)
    //         return view('pages.admin.users.profile', compact('data', 'id','action', 'add'));
    //     else
    //         return redirect()->back()->with(['status' => 'Warning', 'class' => 'warning', 'msg' => "NO record Found!"]);
    // }

    // public function updateprofile(Request $request)
    // {
    //     // echo"<pre>";print_r($request->all());exit();
    //     $this->validate($request, [
    //         'id' => 'required',
    //     ]);
    //     $id = $request->id;
    //     $user = UserDetail::where('user_id',$id)->first();
    //     // echo"<pre>";print_r($id);exit();

    //     if ($user)
    //     {
    //         $this->validate($request, [
    //             'name' => 'required',
    //             'id' => 'required',
    //             'dob' => 'required',
    //             'gender' => 'required',
    //             'nationality' => 'required',
    //             'phone' => 'required|unique:user_details,phone,' . $user->id,
    //             'email' => 'required|unique:user_details,email,' . $user->id,
    //         ]);
    //     }
    //     else
    //     {
    //         $this->validate($request, [
    //             'name' => 'required',
    //             'id' => 'required',
    //             'dob' => 'required',
    //             'gender' => 'required',
    //             'nationality' => 'required',
    //             'phone' => 'required|unique:user_details,phone',
    //             'email' => 'required|unique:user_details,email',
    //         ]);
    //         $user = new UserDetail;
    //     }
    //     $user->user_id = $request->id;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->gender = $request->gender;
    //     $user->nationality = $request->nationality;
    //     $user->phone = $request->phone;
    //     $user->dob = date('Y-m-d',strtotime($request->dob));

    //     if ($request->hasFile('picture')) {
    //         // $filename = $request->file('picture')->getClientOriginalExtension();
    //         // $path = Storage::disk('s3')->putFileAs('picture',$request->picture,$filename ,'public');
    //         // $user->picture = config('filesystems.disks.s3.url').'/'.$path;

    //        $file = request()->file('picture');
    //        $ext = $file->getClientOriginalExtension();
    //        $name = $file->storeAs('picture', $request->input('id').'-'.$request->input('name').now()->format('d-m-Y-H-i-s').$ext ,['disk' => 'public']);
    //        $user->picture = $name;
    //     }
    //     $user->save();
    //     // echo"<pre>";print_r($data);exit();
    //     return redirect()->back()->with(['status' => 'Success', 'class' => 'success', 'msg' => "Profile Updated Successfully!"]);
    // }

    public function View($id)
    {
        $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        $title = 'Testing';
        $body = 'Is it Working?';
        // $result = sendNotification($title,$body,$fcmTokens);
        // dd($result);
        $data['user_info'] = User::with('roles')->find($id);
        return view('pages.admin.users.view', $data);
    }

    public function changeUserRoleModal(int $id)
    {
        $data['user_id'] = $id;
        $data['roles'] = Role::whereNotIn('id', [1,3, CommonFunction::getUserRoleIdByUserId($id)])->get();
        return view('pages.admin.users.change-user-role', $data)->render();
    }

    public function changeUserRoleSave(Request $request)
    {
        $user = User::find($request->user_id);
        $user->roles()->detach();
        $user->assignRole($request->role_id);

        return redirect()->back()->with(['success' => 'The user role has been changed successfully']);
    }
}
