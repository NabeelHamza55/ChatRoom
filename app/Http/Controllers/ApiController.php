<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\Report;
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
    Public function submitSuggestion(Request $request){
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
    public function submitReport(Request $request){
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
            Report::create([
                'user_id' => $request->user_id,
                'description' => $request->description
            ]);
            $api_status = 200;
            $status = true;
            $message = "Report submition response";
            $data = "Suggestion request successfull";
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    public function createObjective(Request $request){
        if (empty($request->title)) {
            $msg = 'Parameters are missing';
        }
        if (empty($request->date)) {
            $ $msg = 'Parameters are missing';
        }
        if(empty($request->etc)){
            $msg = 'Parameters are missing';
        }
        if(empty($request->status)){
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
            Objective::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'date' => date('Y-m-d',strtotime($request->date)),
                'etc' => $request->etc,
                'status' => $request->status
            ]);
            $api_status = 200;
            $status = true;
            $message = "Objective response";
            $data = "Objective request successfull";
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    public function fetchObjective($id){
        $objectives = Objective::where('user_id', $id)->get();
        if (empty($objectives)) {
            $msg = 'No Objective Found';
        }
        if(!empty($msg)){
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = [];
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "Objective response";
            $data = $objectives;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    public function fetchUserProfile($id){
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            $msg = 'User Not Found';
        }
        if(!empty($msg)){
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass();
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "Objective response";
            $data = $user;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
}
