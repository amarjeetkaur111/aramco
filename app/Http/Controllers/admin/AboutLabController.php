<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\about_the_lab_pages;
use App\Models\Apis\about_the_lab_templates;
use App\Models\Apis\about_the_lab_content;
use App\Models\Apis\about_the_lab_list_points;

use Illuminate\Support\Facades\Storage;
use DB;
use DataTables;
use File;

class AboutLabController extends Controller
{
    //

    public function index(Request $request){



        if($request->ajax()){
            $data = about_the_lab_pages::select('*');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('icon_image', function($row){

                        $icon_image = '<img src="'.$row->page_icon.'" style="width:20%">';
                         return $icon_image;
                 })

                    ->addColumn('banner_image', function($row){
                        $img = '<img src="'.$row->page_banner.'" style="width:20%">';
                         return $img;
                 })
                    ->addColumn('action', function($row){

                             $icon="fa-eye";
                             $title="Activate this Page";
                            if($row->status==1){

                                $icon="fa-eye-slash";

                                $title="De-activate this Page";
                            }

                           $btn = '<div class="actionelementsdiv"><a  href="'.route('admin-aboutlab-editpage',['id' => $row->id]).'" class="table-action-link" title="Edit Page"> <i class="fas fa-edit"></i></a>';
                           $btn .= '<a href="#" class="table-action-link delete-page" title="Delete Page" data-id="'. $row->id.'"> <i class="fas fa-trash-alt"></i></a>';
                           $btn .= '<a href="'.route('admin-aboutlab-pagecomponents',['pageid' => $row->id]).'" class="table-action-link "  title="View Page Components"><i class="fas fa-book-open"></i></a>';
                           $btn .= '<a href="'.route('admin-aboutlab-pagecomponents',['pageid' => $row->id]).'" class="table-action-link status-page" title="'. $title.'" data-id="'. $row->id.'"   data-msg="Are you sure you want to '. $title.' ?"><i class="fas '.$icon.'"></i></a></div>';
                            return $btn;
                    })
                    ->rawColumns(['icon_image','banner_image','action'])
                    ->make(true);


        }
        return view('pages.admin.aboutlab.index');


    }

    public function addPage(){


        return view('pages.admin.aboutlab.add-page');


    }

    public function savePage(Request $request){


        $image_banner=$request->image_banner;
        $image_icon=$request->image_icon;


            if (env('STORAGE') == "local") {

                $banner_filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). rand(). '.' . $image_banner->getClientOriginalExtension();
                $fileup = $image_banner->storeAs('aboutthelab', $banner_filename, ['disk' => 'my_files']);
                $banner_file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $banner_filename;

            }

            if (env('STORAGE') == "s3") {

                $banner_filename = time() . rand() . '.' . $image_banner->getClientOriginalExtension();
                $banner_path = Storage::disk('s3')->putFileAs('', $image_banner, "aboutthelab/" . $banner_filename, 'public');
                $banner_file_path = config('filesystems.disks.s3.url') . '/' . $banner_path;
            }



            if (env('STORAGE') == "local") {

                $icon_filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). rand(). '.' . $image_icon->getClientOriginalExtension();
                $fileup = $image_icon->storeAs('aboutthelab', $icon_filename, ['disk' => 'my_files']);
                $icon_file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $icon_filename;

            }

            if (env('STORAGE') == "s3") {

                $icon_filename = time() . rand() . '.' . $image_icon->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $image_icon, "aboutthelab/" . $icon_filename, 'public');
                $icon_file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }




            $about_the_lab_page=new about_the_lab_pages;
            $about_the_lab_page->page_title=$request->page_title;
            $about_the_lab_page->page_heading=$request->page_heading;
            $about_the_lab_page->page_desc=$request->page_desc;
            $about_the_lab_page->page_icon=$icon_file_path;
            $about_the_lab_page->page_icon_name=$icon_filename;
            $about_the_lab_page->page_banner	=$banner_file_path;
            $about_the_lab_page->page_banner_name		=$banner_filename;
            $about_the_lab_page->storage	=env('STORAGE');
            $about_the_lab_page->save();







            return redirect()->route('admin-aboutlab-pages')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Page has been created Successfully!"]);



    }

    public function editPage(Request $request){


        $pagedata =about_the_lab_pages::select('*')
        ->where('id',$request->id)
        ->get()->toArray();


        return view('pages.admin.aboutlab.edit-page',compact('pagedata'));


    }



    public function updatePage(Request $request){

        $pageid=$request->pageid;

        $pagedata =about_the_lab_pages::select('*')
        ->where('id',$pageid)
        ->get();


        if($request->hasFile('image_banner')){

            $image_banner=$request->image_banner;

            if (env('STORAGE') == "local") {

                $banner_filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). rand(). '.' . $image_banner->getClientOriginalExtension();
                $fileup = $image_banner->storeAs('aboutthelab', $banner_filename, ['disk' => 'my_files']);
                $banner_file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $banner_filename;

                if (File::exists(public_path('uploads/aboutthelab/'.$pagedata[0]->page_banner_name))) {
                    File::delete(public_path('uploads/aboutthelab/'.$pagedata[0]->page_banner_name));
                }

            }

            if (env('STORAGE') == "s3") {

                $banner_filename = time() . rand() . '.' . $image_banner->getClientOriginalExtension();
                $banner_path = Storage::disk('s3')->putFileAs('', $image_banner, "aboutthelab/" . $banner_filename, 'public');
                $banner_file_path = config('filesystems.disks.s3.url') . '/' . $banner_path;
            }

        }

        if($request->hasFile('image_icon')){
            $image_icon=$request->image_icon;

            if (env('STORAGE') == "local") {

                $icon_filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). rand(). '.' . $image_icon->getClientOriginalExtension();
                $fileup = $image_icon->storeAs('aboutthelab', $icon_filename, ['disk' => 'my_files']);
                $icon_file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $icon_filename;



                if (File::exists(public_path('uploads/aboutthelab/'.$pagedata[0]->page_icon_name))) {
                    File::delete(public_path('uploads/aboutthelab/'.$pagedata[0]->page_icon_name));
                }

            }

            if (env('STORAGE') == "s3") {

                $icon_filename = time() . rand() . '.' . $image_icon->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('', $image_icon, "aboutthelab/" . $icon_filename, 'public');
                $icon_file_path = config('filesystems.disks.s3.url') . '/' . $path;
            }


        }




            $about_the_lab_page= about_the_lab_pages::findOrNew($pageid);
            $about_the_lab_page->page_title=$request->page_title;
            $about_the_lab_page->page_heading=$request->page_heading;
            $about_the_lab_page->page_desc=$request->page_desc;
            if($request->hasFile('image_icon')){

            $about_the_lab_page->page_icon=$icon_file_path;
            $about_the_lab_page->page_icon_name=$icon_filename;
             }
            if($request->hasFile('image_banner')){
            $about_the_lab_page->page_banner	=$banner_file_path;
            $about_the_lab_page->page_banner_name		=$banner_filename;

            $about_the_lab_page->storage	=env('STORAGE');
            }
            $about_the_lab_page->save();







            return redirect()->route('admin-aboutlab-pages')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Page has been updated Successfully!"]);



    }


    public function DeletePage(Request $request){


        $pageid=$request->pageid;


        $pagedata =about_the_lab_pages::select('*')
        ->where('id',$pageid)
        ->get();

        if (env('STORAGE') == "local") {


                if (File::exists(public_path('uploads/aboutthelab/'.$pagedata[0]->page_icon_name))) {
                    File::delete(public_path('uploads/aboutthelab/'.$pagedata[0]->page_icon_name));
                }

                if (File::exists(public_path('uploads/aboutthelab/'.$pagedata[0]->page_banner_name))) {
                    File::delete(public_path('uploads/aboutthelab/'.$pagedata[0]->page_banner_name));
                }

        }



        about_the_lab_pages::where('id', $pageid)->delete();


        $page_content_count =about_the_lab_content::select('id')->where('about_the_lab_pages_id',$pageid)->count();

        if($page_content_count>0){


            $page_content_data =about_the_lab_content::select('*')->where('about_the_lab_pages_id',$pageid)->where('image_name','<>',Null)
            ->get();

               foreach($page_content_data  as $imagedata){

                if (env('STORAGE') == "local") {
                if (File::exists(public_path('uploads/aboutthelab/'.$imagedata->image_name))) {
                    File::delete(public_path('uploads/aboutthelab/'.$imagedata->image_name));
                }

            }

               }

               about_the_lab_content::where('about_the_lab_pages_id', $pageid)->delete();


        }




        return redirect()->route('admin-aboutlab-pages')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Page has been deleted Successfully!"]);

    }


    public function pageComponents(Request $request){

           $pageid=$request->pageid;

        $contents =about_the_lab_content::select('about_the_lab_content.*','about_the_lab_templates.template_name','about_the_lab_templates.template_slug')
        ->join('about_the_lab_templates', 'about_the_lab_content.about_the_lab_templates_id', '=', 'about_the_lab_templates.id')
        // ->where('about_the_lab_content.status', 1)
        ->where('about_the_lab_templates.template_slug','<>', 'headertext')
        ->where('about_the_lab_content.about_the_lab_pages_id', $pageid)
        ->orderBy('about_the_lab_content.component_order', 'ASC')
        ->get()->toArray();




            $finalarr=array();
            $counter=1;
            foreach($contents as $content){




                            if($content['template_slug']=="image_text"){

                                $finalarr[]= array(
                                    "id" => $content['id'],
                                    "component_order" => $content['component_order'],
                                    "component_title" => $content['component_title'],
                                    "order" => $content['component_order'],
                                    "template" => $content['template_name'],
                                    "image" => $content['image'],
                                    "text" => $content['text'],
                                    "status" => $content['status'],
                                    "created_at" => $content['created_at'],

                                );


                            }

                            if($content['template_slug']=="text_image"){

                                $finalarr[]= array(
                                    "id" => $content['id'],
                                    "component_order" => $content['component_order'],
                                    "component_title" => $content['component_title'],
                                    "order" => $content['component_order'],
                                    "template" => $content['template_name'],
                                    "text" => $content['text'],
                                    "image" => $content['image'],
                                    "status" => $content['status'],
                                    "created_at" => $content['created_at'],

                                );


                            }


                            if($content['template_slug']=="only_image"){

                                $finalarr[]= array(
                                    "id" => $content['id'],
                                    "component_order" => $content['component_order'],
                                    "component_title" => $content['component_title'],
                                    "order" => $content['component_order'],
                                    "template" => $content['template_name'],
                                    "image" => $content['image'],
                                    "status" => $content['status'],
                                    "created_at" => $content['created_at'],

                                );


                            }

                            if($content['template_slug']=="only_text"){

                                $finalarr[]= array(
                                    "id" => $content['id'],
                                    "component_order" => $content['component_order'],
                                    "component_title" => $content['component_title'],
                                    "order" => $content['component_order'],
                                    "template" => $content['template_name'],
                                    "text" => $content['text'],
                                    "status" => $content['status'],
                                    "created_at" => $content['created_at'],

                                );


                            }

                            if($content['template_slug']=="list"){


                                $list_points =about_the_lab_list_points::select('list_point_title')
                                ->where('about_the_lab_content_id', $content['id'])
                                ->get()->toArray();



                                $list=array();

                                foreach($list_points as $points){
                                    $list[]=$points['list_point_title'];


                                }


                                $finalarr[]= array(
                                    "id" => $content['id'],
                                    "component_order" => $content['component_order'],
                                    "component_title" => $content['component_title'],
                                    "order" => $content['component_order'],
                                    "template" => $content['template_name'],
                                    "list_title" => $content['list_title'],
                                    "status" => $content['status'],
                                    "created_at" => $content['created_at'],
                                    "list" => $list,

                                );


                            }


                            $counter++;

                }

        return view('pages.admin.aboutlab.pagecomponents',compact('finalarr','pageid'));


    }



    public function addComponent(Request $request){


        $pageid=$request->pageid;

        $templates=$this->getTemplates();


        return view('pages.admin.aboutlab.add-comp',compact('templates','pageid'));


    }
    public function editComponent(Request $request){


        $data =about_the_lab_content::select('about_the_lab_content.*','about_the_lab_templates.template_name','about_the_lab_templates.template_slug')
        ->join('about_the_lab_templates', 'about_the_lab_content.about_the_lab_templates_id', '=', 'about_the_lab_templates.id')
        // ->where('about_the_lab_content.status', 1)
        ->where('about_the_lab_content.id', $request->id)
        ->get();





        $contents=array();
        // foreach($contents as $data){

            $about_the_lab_list_points =about_the_lab_list_points::where('about_the_lab_content_id',$data[0]->id)->get()->toArray();

            $contents['id']=$data[0]->id;
            $contents['component_title']=$data[0]->component_title;
            $contents['image']=$data[0]->image;
            $contents['text']=$data[0]->text;
            $contents['list_title']=$data[0]->list_title;
            $contents['about_the_lab_templates_id']=$data[0]->about_the_lab_templates_id;
            $contents['component_order']=$data[0]->component_order;
            $contents['storage']=$data[0]->storage;
            $contents['status']=$data[0]->status;
            $contents['template_name']=$data[0]->template_name;
            $contents['template_slug']=$data[0]->template_slug;
            $contents['list']=$about_the_lab_list_points;
            $contents['pageid']=$data[0]->about_the_lab_pages_id;


        // }




        $templates=$this->getTemplates();


        return view('pages.admin.aboutlab.edit-comp',compact('contents','templates'));


    }

    public function getTemplates(){


        $templates =about_the_lab_templates::where('template_slug','<>','headertext')->get();
        return $templates;


    }


    public function saveComponent(Request $request){

        //  dd($request->all());

        $template_type=$request->template_type;
        $pageid=$request->pageid;

       $template= about_the_lab_templates::where('template_slug',$template_type)->get();
       $about_the_lab_templates_id=$template[0]->id;





                     $text=null;
                     $file=null;
                     $file_path=null;
                     $image_banner=null;
                     $filename=null;
                     $storage=null;

                     if($template_type=="only_text"){

                       $text=$request->only_text_content;
                     }

                     if($template_type=="text_image"){
                        $image_banner=true;

                        $text=$request->text_image_content;
                        $file=$request->text_image_image;
                        $storage=env('STORAGE');

                      }


                     if($template_type=="image_text"){

                        $image_banner=true;

                        $text=$request->image_text_content;
                        $file=$request->image_text_image;
                        $storage=env('STORAGE');
                      }

                      if($template_type=="only_image"){

                        $image_banner=true;

                       $file=$request->only_image_image;
                       $storage=env('STORAGE');
                      }




                      if ($image_banner) {

                        if (env('STORAGE') == "local") {

                            $filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). '.' . $file->getClientOriginalExtension();
                            $fileup = $file->storeAs('aboutthelab', $filename, ['disk' => 'my_files']);
                            $file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $filename;

                        }

                        if (env('STORAGE') == "s3") {

                            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                            $path = Storage::disk('s3')->putFileAs('', $file, "aboutthelab/" . $filename, 'public');
                            $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                        }


                    }


                    $maxorder=about_the_lab_content::where('about_the_lab_pages_id',$pageid)->max('component_order');
                    $component_order=$maxorder+1;

                     $about_the_lab_content=new about_the_lab_content;
                     $about_the_lab_content->about_the_lab_pages_id=$pageid;
                     $about_the_lab_content->component_title=$request->component_title;
                     $about_the_lab_content->text=$text;
                     $about_the_lab_content->image=$file_path;
                     $about_the_lab_content->image_name=$filename;
                     $about_the_lab_content->list_title=$request->list_title;
                     $about_the_lab_content->about_the_lab_templates_id	=$about_the_lab_templates_id;
                     $about_the_lab_content->component_order	=$component_order;
                     $about_the_lab_content->storage	=$storage;
                     $about_the_lab_content->save();
                     $conetnt_id=$about_the_lab_content->id;

                  if($template_type=="list"){


                        $list_item= $request->list_items;
                        foreach($list_item as $item){



                            $about_the_lab_list_points=new about_the_lab_list_points;
                            $about_the_lab_list_points->list_point_title=$item;
                            $about_the_lab_list_points->about_the_lab_content_id=$conetnt_id;
                            $about_the_lab_list_points->save();


                        }
                    }



                    // return redirect()->route('admin-forum-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Forum has been {$add}ed Successfully!"]);
                    // return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid]);
                    return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid])->with(['status' => 'Success', 'class' => 'success', 'msg' => "Component has been added Successfully!"]);



    }

    public function updateComponent(Request $request){

        //  dd($request->all());

        $pageid=$request->pageid;
        $component_id=$request->component_id;
        $template_type=$request->template_type;

       $template= about_the_lab_templates::where('template_slug',$template_type)->get();
       $about_the_lab_templates_id=$template[0]->id;





                     $text=null;
                     $file=null;
                     $file_path=null;
                     $image_banner=false;
                     $storage=null;
                     $list_title=null;

                     if($template_type=="only_text"){

                       $text=$request->only_text_content;
                     }

                     if($template_type=="text_image"){


                        $text=$request->text_image_content;

                        if($request->hasFile('text_image_image_update')){
                        $file=$request->text_image_image_update;
                        $image_banner=true;
                        }
                        $storage=env('STORAGE');

                      }


                     if($template_type=="image_text"){


                        $text=$request->image_text_content;

                        if($request->hasFile('image_text_image_update')){
                        $file=$request->image_text_image_update;
                        $image_banner=true;

                        }
                        $storage=env('STORAGE');
                      }

                      if($template_type=="only_image"){



                       if($request->hasFile('only_image_image_update')){

                        $image_banner=true;

                        $file=$request->only_image_image_update;
                       }


                       $storage=env('STORAGE');
                      }

                      if($template_type=="list"){


                       $list_title=$request->list_title;

                      }




                      if ($image_banner) {

                        if (env('STORAGE') == "local") {

                            $filename = str_replace(' ','_',now()->format('d-m-Y-H-i-s') ). '.' . $file->getClientOriginalExtension();
                            $fileup = $file->storeAs('aboutthelab', $filename, ['disk' => 'my_files']);
                            $file_path = env('ASSET_URL') . '/uploads/aboutthelab/' . $filename;

                        }

                        if (env('STORAGE') == "s3") {

                            $filename = time() . rand() . '.' . $file->getClientOriginalExtension();
                            $path = Storage::disk('s3')->putFileAs('', $file, "aboutthelab/" . $filename, 'public');
                            $file_path = config('filesystems.disks.s3.url') . '/' . $path;
                        }


                    }



                     $about_the_lab_content= about_the_lab_content::findOrNew($component_id);
                     $about_the_lab_content->component_title=$request->component_title;
                     $about_the_lab_content->text=$text;
                     if ($image_banner) {
                     $about_the_lab_content->image=$file_path;
                     $about_the_lab_content->image_name=$filename;
                     }
                     $about_the_lab_content->list_title=$list_title;
                     $about_the_lab_content->about_the_lab_templates_id	=$about_the_lab_templates_id;
                     $about_the_lab_content->storage	=$storage;
                     $about_the_lab_content->save();
                     $conetnt_id=$about_the_lab_content->id;

                     $count=about_the_lab_list_points::where('about_the_lab_content_id', $component_id)->count();
                     if($count>0){
                     about_the_lab_list_points::where('about_the_lab_content_id', $component_id)->delete();
                     }

                  if($template_type=="list"){





                        $list_item= $request->list_items;
                        foreach($list_item as $item){



                            $about_the_lab_list_points=new about_the_lab_list_points;
                            $about_the_lab_list_points->list_point_title=$item;
                            $about_the_lab_list_points->about_the_lab_content_id=$conetnt_id;
                            $about_the_lab_list_points->save();


                        }
                    }



                    // return redirect()->route('admin-forum-list')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Forum has been {$add}ed Successfully!"]);
                    return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid])->with(['status' => 'Success', 'class' => 'success', 'msg' => "Component has been updated Successfully!"]);



    }

    public function deleteComponent(Request $request){
        $pageid=$request->pageid;
          $about_the_lab_content=about_the_lab_content::where('id', $request->delete_component_id)->get();

          $order_of_component=$about_the_lab_content[0]->component_order;

          if($about_the_lab_content[0]->image_name!=NULL){
          if (env('STORAGE') == "local") {
            if (File::exists(public_path('uploads/aboutthelab/'.$about_the_lab_content[0]->image_name))) {
                File::delete(public_path('uploads/aboutthelab/'.$about_the_lab_content[0]->image_name));
            }

           }

         }


            $count=about_the_lab_list_points::where('about_the_lab_content_id', $request->delete_component_id)->count();
            if($count>0){
            about_the_lab_list_points::where('about_the_lab_content_id', $request->delete_component_id)->delete();
            }

            about_the_lab_content::where('id', $request->delete_component_id)->delete();

            $about_the_lab_content_orders=about_the_lab_content::where('component_order','>' ,$order_of_component)->where('about_the_lab_pages_id',$pageid)->get();

             foreach($about_the_lab_content_orders as $component_old_order){



                 $about_the_lab_content_neworder = about_the_lab_content::findOrNew($component_old_order->id);
                $neworder = $about_the_lab_content_neworder->component_order-1;
                // $about_the_lab_content_neworder->save();







                $component_arr = array(
                    'component_order' => $neworder ,

                );
                about_the_lab_content::where('id', $component_old_order->id)->where('about_the_lab_pages_id',$pageid)->update($component_arr);







             }

             return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid])->with(['status' => 'Success', 'class' => 'success', 'msg' => "Component has been deleted Successfully!"]);;


    }


    public function updateComponentOrder(Request $request){

        $pageid=$request->pageid;
        $updated_rows_json = $request->updated_rows;
        $updated_rows_ary = json_decode($updated_rows_json, true);
        foreach ($updated_rows_ary as $updated_row) {

      /*   $about_the_lab_content_neworder = about_the_lab_content::findOrNew($updated_row['id']);
        $about_the_lab_content_neworder->component_order = $updated_row['updated_order'];
        $about_the_lab_content_neworder->save(); */


        //    $about_the_lab_content_neworder = about_the_lab_content::findOrNew(['id'=> $updated_row['id'],'about_the_lab_pages_id'=>$pageid]);
        // $about_the_lab_content_neworder->component_order = $updated_row['updated_order'];
        // $about_the_lab_content_neworder->save();



        $component_arr = array(
            'component_order' => $updated_row['updated_order'],

        );
        about_the_lab_content::where('id', $updated_row['id'])->where('about_the_lab_pages_id',$pageid)->update($component_arr);




        }

        return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid])->with(['status' => 'Success', 'class' => 'success', 'msg' => "Component order has been updated Successfully!"]);;





    }


    public function changePageStatus(Request $request){



        $data=about_the_lab_pages::where('id', $request->pageid)->get();
        if( $data[0]->status==1){

            $newstatus=0;


        }else{

            $newstatus=1;

        }

        $arr = array(
            'status' => $newstatus ,

        );
         about_the_lab_pages::where('id', $request->pageid)->update($arr);

        return redirect()->route('admin-aboutlab-pages')->with(['status' => 'Success', 'class' => 'success', 'msg' => "Page status has been changed Successfully!"]);;


    }


    public function changeComponentStatus(Request $request){


        $data=about_the_lab_content::where('id', $request->status_component_id)->get();
        if( $data[0]->status==1){

            $newstatus=0;


        }else{

            $newstatus=1;

        }

        $arr = array(
            'status' => $newstatus ,

        );
        about_the_lab_content::where('id', $request->status_component_id)->update($arr);


        return redirect()->route('admin-aboutlab-pagecomponents',['pageid'=> $request->pageid])->with(['status' => 'Success', 'class' => 'success', 'msg' => "Component status has been changed Successfully!"]);;






    }


}
