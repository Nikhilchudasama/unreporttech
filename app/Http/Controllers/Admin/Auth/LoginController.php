<?php

namespace App\Http\Controllers\Admin\Auth;

use validate;
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
    protected $redirectTo = '/admin/dashboard';


    /**
     * Show login form
     *
     * @return \Illuminate\Http\Response
     **/
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

     /**
       * Get the needed authorization credentials from the request.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return array
       */
    //   protected function credentials(Request $request)
    //   {
    //     if(is_numeric($request->get('email'))){
    //       return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
    //     }
    //     elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
    //       return ['email' => $request->get('email'), 'password'=>$request->get('password')];
    //     }
    //     // return ['username' => $request->get('email'), 'password'=>$request->get('password')];
    //   }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        if(is_numeric($request->get('email'))){
            $credentials =  ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
          }
          elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $credentials =  ['email' => $request->get('email'), 'password'=>$request->get('password')];
          }
        $remember = request()->input('remember')?true:false;

        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('/admin/dashboard');
        // }
        if (Auth::validate($credentials)) {
            $now = time();
            $user = Auth::getLastAttempted();
            if(!$user->active){
                return redirect('/admin')->withErrors([
                    'email' => 'Your Account Deactive.',
                ]);
            }
            Auth::login($user, $remember);
            return redirect()->intended($this->redirectPath());
        }

        return redirect('/admin')->withErrors([
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

        return redirect('/admin');
    }
}
