<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqApi = new \App\Http\Controllers\admin\Apis\FaqController();
        $getFaqs = [];
        if ($faqApi->getAllFaqs()->getData()->success) {
            $getFaqs = $faqApi->getAllFaqs()->getData()->data;
        }
        return view('pages.web.faq.faq', compact('getFaqs'));
    }
}
