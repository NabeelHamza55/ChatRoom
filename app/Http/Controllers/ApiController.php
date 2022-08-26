<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $users = User::all();
        if (empty($users)) {
            $msg = "No user found";
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "login response";
            $data = $users;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    Public function suggestion(Request $request){
        if (empty($request->user_id)) {
            $msg = 'Parameters are missing';
        }
        if (empty($request->description)) {
            $msg = 'Parameters are missing';
        }
        if(!empty($msg)){
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            Suggestion::create([
                'user_id' => $request->user_id,
                'description' => $request->description
            ]);
            $api_status = 200;
            $status = true;
            $message = "Suggestion response";
            $data = "Suggestion request successfull";
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
}
