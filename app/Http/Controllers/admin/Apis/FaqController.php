<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\User;
use App\Models\Apis\faqs;

class FaqController extends Controller
{
    //

    public function getAllFaqs(){


        $faqs = faqs::where('status', 1)->get();
        $response = [
            'success' => true,
            'data' => $faqs,

        ];
        return response()->json($response, 200);





    }
}
