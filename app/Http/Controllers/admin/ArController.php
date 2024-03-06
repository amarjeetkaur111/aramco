<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\ar_navigation;
use DB;
use DataTables;

class ArController extends Controller
{
    //


    public function list(Request $request){

        $faqs = ar_navigation::get();

        if($request->ajax()){
            $data = ar_navigation::select('*');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('arimage', function($row){
                        $img = '<img src="'.$row->ar_image_path.'" style="width:20%">';
                         return $img;
                 })
                    ->addColumn('action', function($row){
                           $btn = '<div class="actionelementsdiv"><a href="'.route('admin-ar-add',['id' => $row->id]).'" class="table-action-link"><i class="fas fa-edit"></i></a></div>';
                            return $btn;
                    })
                    ->rawColumns(['arimage','action'])
                    ->make(true);
        }

        return view('pages.admin.ar.index');


    }
    public function add($id = null)
    {
        $data = null;
        $action = route('admin-ar-store');
        $add = 'Add';

        if($id){
            $data = ar_navigation::find($id);
            $action = route('admin-ar-store',['id' => $id]);
            $add = 'Edit';
        }
        return view('pages.admin.ar.add',compact('data','action','add'));
    }

    public function store(Request $request,$id = null)
    {



        $add = 'Add';
        $ar_navigation = new ar_navigation;
        if ($id) {
            $add = 'Edit';
            $ar_navigation = ar_navigation::find($id);
        }
        // if ($id) {

        //     $this->validate($request, [
        //         'ar_image' => 'required',
        //         'ar_name' => 'required',
        //         // 'permissions' => 'required',
        //     ]);
        // } else {

        //     $this->validate($request, [
        //         'ar_image' => 'required',
        //         'ar_name' => 'required',
        //         // 'permissions' => 'required',
        //     ]);
        // }
        // dd($request->all());

        $ar_file_path=null;

        if($request->hasFile('ar_image')){

            $file= $request->ar_image;


            if (env('STORAGE') == "local") {

                $filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). '.' . $file->getClientOriginalExtension();
                $fileup = $file->storeAs('arnavigation', $filename, ['disk' => 'my_files']);
                $ar_file_path = env('ASSET_URL') . '/uploads/arnavigation/' . $filename;

            }

            if (env('STORAGE') == "s3") {

                $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $file, "arnavigation/" . $filename, 'public');
                $ar_file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }

        }


        $ar_detail_file_path=null;

        if($request->hasFile('ar_detail_image')){

            $file_ar_detail_image= $request->ar_detail_image;


            if (env('STORAGE') == "local") {

                $filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). '.' . $file_ar_detail_image->getClientOriginalExtension();
                $fileup = $file_ar_detail_image->storeAs('arnavigation', $filename, ['disk' => 'my_files']);
                $ar_detail_file_path = env('ASSET_URL') . '/uploads/arnavigation/' . $filename;

            }

            if (env('STORAGE') == "s3") {

                $filename = time() . rand() . '.' . $file_ar_detail_image->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $file_ar_detail_image, "arnavigation/" . $filename, 'public');
                $ar_detail_file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }

        }



        if($ar_file_path!=null){
            $ar_navigation->ar_image_path = $ar_file_path;

        }

        if($ar_detail_file_path!=null){
            $ar_navigation->description_image_path = $ar_detail_file_path;

        }


        $ar_navigation->name = $request->input('ar_name');
        $ar_navigation->destination = $request->input('destination');
        $ar_navigation->description = $request->input('ar_description');
        $ar_navigation->save();

        return redirect()->route('admin-ar-all')->with(['status' => 'Success', 'class' => 'success', 'msg' => "{$add}ed Successfully!"]);
    }

    public function destroy($id)
    {
        DB::table("ar_navigation")->where('id',$id)->delete();
        return redirect()->route('admin.ar.all')->with('success','Question deleted successfully');
    }
}
