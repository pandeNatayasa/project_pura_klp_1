<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('auth_admin.login');
    }

    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        $remember = $request->has('remember') ? true : false;

        //Attempt to log the user in
        if(Auth::guard('admin')->attempt($credential,$remember)){
            return redirect()->intended(route('admin.home'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));

    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
