<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\Booster;
use App\Models\Coaching;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('adminLogout');
    }
    protected $redirectTo = RouteServiceProvider::HOME;

    // public function showLoginForm()
    // {
    //     return view('dashboard.Auth.login');
    // }
    // Admin Auth
    public function adminLoginForm(){
        return view('dashboard.Auth.login');
    }

    public function adminlogin(Request $request){
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Email not registered',
        ]);
        $checkAdmin = Admin::where('email', $request->email)->first();
        if ($checkAdmin->status == 0) {
            return redirect()->back()->withErrors(['email' => 'User is blocked by administrator']);
        }else{
            if (Hash::check($request->password, $checkAdmin->password)) {
                if (Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password]  )) {
                    return redirect()->intended('/dashboard');
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back()->withErrors(['password' => 'Incorrect Password']);
            }
        }
    }

    public function adminLogout(){
        if (!empty(Auth::guard('admin')->user())) {
            Auth::guard('admin')->logout();
        }
        return redirect()->route('AdminLogin');
    }

}
