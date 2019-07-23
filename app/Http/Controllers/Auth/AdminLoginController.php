<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function showLoginForm()
    {
        return view('auth/adminlogin');
    }

    protected function login(Request $request)
    {
        if(filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL))
        {
            $validateParams = [
                'usernameOrEmail' => 'required|email',
                'password' => 'required|string|min:8'
            ];
            $credentials = [
                'email' => $request->usernameOrEmail,
                'password' => $request->password,
                'active' => TRUE,
            ];
        }
        else
        {
            $validateParams = [
                'usernameOrEmail' => 'required|string|min:3',
                'password' => 'required|string|min:8'
            ];
            $credentials = [
                'username' => $request->usernameOrEmail,
                'password' => $request->password,
                'active' => TRUE,
            ];
        }
        $this->validate($request, $validateParams);

        $remember = $request->remember;
        if(Auth::guard('admin')->attempt($credentials, $remember))
        {
            return redirect()->intended($this->redirectTo);
        }
        session()->flash('message', 'Access denied.');
        return redirect()->back()->withInput($request->only('usernameOrEmail', 'remember'));
    }

    protected function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }
    protected function loggedOut(Request $request)
    {
        //
    }
}
