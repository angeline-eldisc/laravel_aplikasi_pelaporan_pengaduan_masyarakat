<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'username'    => 'required|string|min:4|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //validate the request.
        $request->validate($rules);
    }

    private function loginFailed(){
        return redirect()->back()->withInput()->with('error','Login failed, please try again!');
    }

    public function login(Request $request)
    {
        $this->validator($request);
        
        if(Auth::guard('masyarakat')) {
            if(Auth::guard('masyarakat')->attempt(['username'=>$request->username,'password'=>$request->password])){
                return redirect()->intended(route('masyarakat.home'))->with('status','You are now Logged in !');
            }
        }
        
        if (Auth::guard('petugas')) {
            if(Auth::guard('petugas')->attempt($request->only('username','password'))){
                if(Auth::guard('petugas')->user()->status == '1') {
                    if(Auth::guard('petugas')->user()->level == 'Admin'){
                        return redirect()->intended(route('admin.home'))->with('status','You are now Logged in !');
                    } else {
                        return redirect()->intended(route('petugas.home'))->with('status','You are now Logged in !');
                    }
                }elseif(Auth::guard('petugas')->user()->status == '0') {
                    return redirect()->route('login')->withInput()->with('error','Login failed, please try contact the admin to actived your account!');
                }
            }
        }

        return $this->loginFailed();
    }

    public function logout()
    {
        if(Auth::guard('masyarakat')) {
            Auth::guard('masyarakat')->logout();
            return redirect('/login')->with('status','You has been logged out!');
        }
        
        if (Auth::guard('petugas')) {
            Auth::guard('petugas')->logout();
            return redirect('/login')->with('status','You has been logged out!');
        }
    }
}
