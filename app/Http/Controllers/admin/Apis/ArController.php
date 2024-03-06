<?php

namespace App\Http\Controllers\admin\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apis\ar_navigation;
use DB;
use DataTables;

class ArController extends Controller
{
    //

    public function getAllAr(){


        $ar_navigation = ar_navigation::get();
        $response = [
            'success' => true,
            'data' => $ar_navigation,

        ];
        return response()->json($response, 200);





    }
}
