<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutLabController extends Controller
{
    private $AboutLabController;
    public function index(Request $request, $page_id)
    {
//
        try {
            $components = [];
            $page_heading ="";
            $page_title = "";

            $this->AboutLabController = new \App\Http\Controllers\admin\Apis\AboutLabController();

            $request->merge([
                'pageid' => $page_id
            ]);

            $getComponent = $this->AboutLabController->getPageContent($request)->getData();

            if ($getComponent->success) {
                $components = $getComponent->data;
                $page_heading = $getComponent->page_heading;
                $page_title = $getComponent->page_title;
            }

            $sliders = $this->getSliderData();

            return view('pages.web.about', compact('page_heading','components', 'sliders', 'page_id', 'page_title'));
        }catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine());
            abort('404', 'Something went wrong');
        }
    }

    public function getSliderData()
    {
        $pages = [];
        $this->AboutLabController = new \App\Http\Controllers\admin\Apis\AboutLabController();
        $getPages = $this->AboutLabController->getPages()->getData();

        if ($getPages->success) {
            $pages = $getPages->data;
        }

        return $pages;
    }
}
