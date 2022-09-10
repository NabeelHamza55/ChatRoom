<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Block;
use App\Models\Follow;
use App\Models\Report;
use App\Models\Objective;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

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
        if (empty($request->report_against)) {
            $msg = 'Parameters are missing';
        }else{
            if (gettype($request->report_against)  != "integer") {
                $msg = "Data must be an integer";
            }else{
                if ($request->user_id == $request->report_against) {
                   $msg = "User Can't report againt its own id";
                }
            }
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
                'description' => $request->description,
                'report_against' => $request->report_against,
                'status' => 2
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
    public function updateUserProfile(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
        ]);
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->save();
        $api_status = 200;
        $status = true;
        $message = "User name updated successfully";
        $data = $user;
        $response = compact('api_status', 'status', 'message', 'data');
        return response($response, 200);
    }
    public function follow(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'follower_id' => 'required|integer'
        ]);
        $check = Follow::where('user_id', $request->user_id)->where('follow_by', $request->follower_id)->first();
        if (!empty($check)) {
            $api_status = 200;
            $status = true;
            $message = "Follow response Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }else{
            Follow::create([
                'user_id' => $request->user_id,
                'follow_by'=> $request->follower_id
            ]);
            $api_status = 200;
            $status = true;
            $message = "Follow response Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }
    }
    public function unFollow(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'follower_id' => 'required|integer'
        ]);
        $check = Follow::where('user_id', $request->user_id)->where('follow_by', $request->follower_id)->first();
        if (!empty($check)) {
            $check->delete();
            $api_status = 200;
            $status = true;
            $message = "UnFollow response Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "UnFollow response Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }
    }
    public function block(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'block_by' => 'required|integer'
        ]);
        $check = Block::where('user_id', $request->user_id)->where('block_by', $request->block_by)->first();
        if (!empty($check)) {
            $api_status = 200;
            $status = true;
            $message = "User Already Blocked";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }else{
            Block::create([
                'user_id' => $request->user_id,
                'block_by'=> $request->block_by
            ]);
            $api_status = 200;
            $status = true;
            $message = "Block response Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }
    }
    public function unBlock(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'block_by' => 'required|integer'
        ]);
        $check = Block::where('user_id', $request->user_id)->where('block_by', $request->block_by)->first();
        if (!empty($check)) {
            $check->delete();
            $api_status = 200;
            $status = true;
            $message = "User unBlocked Successfull";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "Fail Something Wrong";
            $response = compact('api_status', 'status', 'message');
            return response($response, 200);
        }
    }
}
