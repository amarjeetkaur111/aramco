<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    private $AboutLabController;

    //
    public function index() {
        try {
            $pages = [];
            $this->AboutLabController = new \App\Http\Controllers\admin\Apis\AboutLabController();
            $getPages = $this->AboutLabController->getPages()->getData();

            if ($getPages->success) {
                $pages = $getPages->data;
            }

            return view('pages.web.home', compact('pages'));

        }catch (\Exception $e) {
            //dd($e->getMessage());
            abort('404', 'Something went wrong');
        }
    }


    public function privacy() {
        return view('pages.web.privacy');
    }

    public function terms() {
        return view('pages.web.terms');
    }

    public function cookies() {
        return view('pages.web.cookies');
    }


}
