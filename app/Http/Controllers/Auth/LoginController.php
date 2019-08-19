<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            session()->flash('success', '欢迎回来！');
            return redirect()->route("index",[Auth::user()]);
        }
        session()->flash('danger', '账号或密码错误！');
        return redirect()->back()->withInput();

    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }


}
