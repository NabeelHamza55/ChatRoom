<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $users = User::all();
        return view('dashboard.users.list', compact('users'));
    }
    public function create(){
        return view('dashboard.users.form');
    }
    public function store(Request $request){
        $request->flash();
        $request->validate([
            'name' => 'required',
            'username' => 'required_with:name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'passwordConfirmation' => 'required|same:password',
        ],[
            'name.required' => 'Name is required',
            'username.required_with' => 'Username is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
            'passwordConfirmation.required' => 'Password confirmation is required',
            'passwordConfirmation.same' => 'Password confirmation failed',
        ]);
        if (empty($request->status)) {
            $status = 0;
        }else{
            $status = 1;
        }
        if ($request->has('image')) {
            $image = $this->uploadImage($request->image);
        }

        $checkUsername = User::where('name', $request->name)->latest('id')->first();
        if (empty($checkUsername)) {
            $username = $request->username;
        }else{
            $username = $request->username.$checkUsername->id;
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $status;
        $user->birthday = date('Y-m-d', strtotime($request->birthday));
        $user->about = $request->about;
        $user->avatar = $image ?? NULL;
        $user->save();

        return redirect()->route('UserList')->with('success', 'User created successfully');
    }
    public function edit($id){
        $id = decrypt($id);
        $item = User::find($id);
        return view('dashboard.users.form', compact('item'));
    }
    public function update(Request $request, $id){
        $id = decrypt($id);
        $request->flash();
        $request->validate([
            'name' => 'required',
            'username' => 'required_with:name',
            'email' => 'required|email|unique:users,email,'.$id,
            'passwordConfirmation' => 'required_with:password|same:password',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'passwordConfirmation.required_with' => 'Password confirmation is required',
            'passwordConfirmation.same' => 'Password confirmation failed',
        ]);
        if (empty($request->status)) {
            $status = 0;
        }else{
            $status = 1;
        }
        $checkUsername = User::where('name', $request->name)->where('id !=', $id)->latest('id')->first();
        if (empty($checkUsername)) {
            $username = $request->username;
        }else{
            $username = $request->username.$checkUsername->id;
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $username;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $status;
        $user->birthday = date('Y-m-d', strtotime($request->birthday));
        $user->about = $request->about;
        if ($request->has('image')) {
            $image = $this->uploadImage($request->image);
            $user->avatar = $image;
        }
        $user->save();
        return redirect()->route('UserList')->with('success', 'User updated successfully');
    }
    public function destroy($id){
        $id = decrypt($id);
        $user = User::find($id);
        if (empty($user)) {
            echo 0;
        }else{
            $user->delete();
            echo 1;
        }
    }
    protected function uploadImage($image){
        if (!empty($image)) {
            $imageName1 = $image->getClientOriginalName();
            $imageName = str_replace(' ', "", $imageName1);
            $path = 'uploads/images/users/'.$imageName;
            if (!file_exists(public_path('uploads/images/users/'))) {
                $image->move(public_path('uploads/images/users'), $imageName);
            }
            return $path;
        }
    }
}
