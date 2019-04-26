<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/super-admin/dashboard';


    /**
     * Show login form
     *
     * @return \Illuminate\Http\Response
     **/
    public function showLoginForm()
    {
        return view('super_admin.auth.login');
    }


     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = request()->input('remember')?true:false;
        
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/super-admin/dashboard');
        }
       
        return redirect('/super-admin')->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        return redirect('/super-admin');
    }
}
