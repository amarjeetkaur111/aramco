<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\faqs;
use DB;
use DataTables;

class faqController extends Controller
{

    public function Faqs(Request $request){

        $faqs = faqs::get();

        if($request->ajax()){
            $data = faqs::select('*');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<div class="actionelementsdiv"><a href="'.route('admin-faqs-add',['id' => $row->id]).'" class="table-action-link" title="Edit FAQ"><i class="fas fa-edit"></i></a>';
                           $btn .= '<a href="#" class="table-action-link delete-faq" title="Delete FAQ" data-id="'. $row->id.'"> <i class="fas fa-trash-alt"></i></a></div>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.admin.faqs.index');


    }
    public function add($id = null)
    {
        $data = null;
        $action = route('admin-faqs-store');
        $add = 'Add';
        $faqs = faqs::get();
        if($id){
            $data = faqs::find($id);
            $action = route('admin-faqs-store',['id' => $id]);
            $add = 'Edit';
        }
        return view('pages.admin.faqs.add',compact('data','action','add','faqs'));
    }

    public function store(Request $request,$id = null)
    {
        $add = 'Add';
        $faqs = new faqs;
        if ($id) {
            $add = 'Edit';
            $faqs = faqs::find($id);
        }
        if ($id) {

            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required',
                // 'permissions' => 'required',
            ]);
        } else {

            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required',
                // 'permissions' => 'required',
            ]);
        }
        $faqs->question = $request->input('question');
        $faqs->answer = $request->input('answer');
        $faqs->save();
        // $role->syncPermissions($request->input('permissions'));
        return redirect()->route('admin-faqs-all')->with(['status' => 'Success', 'class' => 'success', 'msg' => "{$add}ed Successfully!"]);
    }

    public function DeleteFAQ(Request $request)
    {
        $faqid=$request->faqid;
        faqs::where('id', $faqid)->delete();

        return redirect()->route('admin-faqs-all')->with(['status' => 'Success', 'class' => 'success', 'msg' =>'Question deleted successfully']);
    }
}
