<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $user = Auth::user();        
        $this->performLogout($request);
        $request->session()->invalidate();
        if ($user->isAdmin() || $user->isSeller()) {
            return redirect('/');
        }        
        return redirect('/');
    }
    // function to run after the user is authenticated
    protected function authenticated(Request $request, $user)
    {
        if ( $user->isAdmin() ) {// do your margic here
            return redirect()->route('admin_dashboard');
        }

        return redirect('/');
    }
    // credentials for making the user login by email or username
    protected function credentials(Request $request)
    {   
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
        ? $this->username()
        : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }

}
