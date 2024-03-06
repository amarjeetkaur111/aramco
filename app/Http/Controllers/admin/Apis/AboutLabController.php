<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\about_the_lab_templates;
use App\Models\Apis\about_the_lab_pages;
use App\Models\Apis\about_the_lab_content;
use App\Models\Apis\about_the_lab_list_points;

class AboutLabController extends Controller
{
    //


    public function getPages(){


        $pagesdata =about_the_lab_pages::select('*')
        ->where('status', 1)
        ->get()->toArray();

        $finalarr=array();

        if(count($pagesdata)>0){

            foreach($pagesdata as $content){

                $content_exists=0;
                $content_count=about_the_lab_content::select('id')->where('about_the_lab_pages_id',  $content['id'])->count();

                if($content_count>0){

                    $content_exists=1;
                }


                $finalarr[]= array(
                    "pageid" => $content['id'],
                    "page_title" => $content['page_title'],
                    "page_heading" => $content['page_heading'],
                    "page_desc" => $content['page_desc'],
                    "page_icon" => $content['page_icon'],
                    "page_banner" => $content['page_banner'],
                    "page_content_exixts" => $content_exists,
                   );



            }



            $response = [
                'success' => true,
                'data' => $finalarr,
            ];

            $code = 200;

            return response()->json($response, $code);



        } else {
            $error = 'Sorry! No record found';
            $response = [
                'success' => false,
                'message' => $error,
            ];
            $code = 404;
            return response()->json($response, $code);
}


    }


    public function getPageContent(Request $request){


        $finalarr=array();

                $pagedata =about_the_lab_pages::select('*')
                ->where('id', $request->pageid)
                ->where('status', 1)
                ->get()->toArray();

        if(count($pagedata)>0){





               $contents =about_the_lab_content::select('about_the_lab_content.*','about_the_lab_templates.template_name','about_the_lab_templates.template_slug')
                  ->join('about_the_lab_templates', 'about_the_lab_content.about_the_lab_templates_id', '=', 'about_the_lab_templates.id')
                  ->where('about_the_lab_content.about_the_lab_pages_id', $pagedata[0]['id'])
                  ->where('about_the_lab_content.status', 1)

                  ->orderBy('about_the_lab_content.component_order', 'ASC')
                  ->get()->toArray();





        $counter=1;
        foreach($contents as $content){


                            // if($content['template_slug']=="headertext"){

                            //     $finalarr[]= array(
                            //         "order" => $content['component_order'],
                            //         "template" => $content['template_slug'],
                            //         "text" => $content['text'],

                            //     );


                            // }

                            if($content['template_slug']=="image_text"){

                                $finalarr[]= array(
                                    "order" => $content['component_order'],
                                    "template" => $content['template_slug'],
                                    "image" => $content['image'],
                                    "text" => $content['text'],

                                );


                            }

                            if($content['template_slug']=="text_image"){

                                $finalarr[]= array(
                                    "order" => $content['component_order'],
                                    "template" => $content['template_slug'],
                                    "text" => $content['text'],
                                    "image" => $content['image'],

                                );


                            }


                            if($content['template_slug']=="only_image"){

                                $finalarr[]= array(
                                    "order" => $content['component_order'],
                                    "template" => $content['template_slug'],
                                    "image" => $content['image'],

                                );


                            }

                            if($content['template_slug']=="only_text"){

                                $finalarr[]= array(
                                    "order" => $content['component_order'],
                                    "template" => $content['template_slug'],
                                    "text" => $content['text'],

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
                                    "order" => $content['component_order'],
                                    "template" => $content['template_slug'],
                                    "list_title" => $content['list_title'],
                                    "list" => $list,

                                );


                            }


                            $counter++;

                }


                $response = [
                    'success' => true,
                    "pageid" => $pagedata[0]['id'],
                    "page_title" => $pagedata[0]['page_title'],
                    "page_heading" => $pagedata[0]['page_heading'],
                     'data' => $finalarr,
                ];

                $code = 200;

                return response()->json($response, $code);



            } else {
                $error = 'Sorry! No record found';
                $response = [
                    'success' => false,
                    'message' => $error,
                ];
                $code = 404;
                return response()->json($response, $code);
}



    }




}
