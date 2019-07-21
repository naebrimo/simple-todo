<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        if(Auth::guard()->attempt($credentials, $remember))
        {
            return redirect()->intended($this->redirectTo);
        }
        session()->flash('message', 'Access denied.');
        return redirect()->back()->withInput($request->only('usernameOrEmail', 'remember'));
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }

}
