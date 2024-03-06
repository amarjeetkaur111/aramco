<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\admin\ApiBaseController as ApiBaseController;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());

            $response = [
                'success' => false,
                'message' => 'Validation Error.',
            ];

            if(!empty($errorMessages)){
                $response['data'] =  $validator->errors();
            }

            return response()->json($response, 404);

        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = ApiUser::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::guard('partner-api')->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::guard('partner-api')->user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['robins_accesstoken'] =  env('ROBIN_ACCESS_TOKEN');
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

            $response = [
                'success' => false,
                'message' => 'Unauthorised.',
            ];

            return response()->json($response, 404);

        }
    }






}
