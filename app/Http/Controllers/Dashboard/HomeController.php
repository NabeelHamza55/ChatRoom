<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $users = User::all();
        $faqs = 0;
        $userlist = User::where('status', 1)->limit(10)->latest('id')->get();
        return view('dashboard.dashboard', compact('users','userlist', 'faqs'));
    }
}
