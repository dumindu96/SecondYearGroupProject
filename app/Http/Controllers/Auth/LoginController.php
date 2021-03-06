<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    use AuthenticatesUsers;

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);


        $this->authenticated($request, $this->guard()->user());
        $user = User::where('email', $request->email)->first();

        if($user->is_tutor==1 && $user->is_student==1 )  //if user is registered as both tutor and student redirect to /tutor
        {
            return redirect()->intended('/tutor');
        }
        elseif($user->is_tutor==1 && $user->is_student==0) //if user is registered as tutor redirect to /tutor
        {
            return redirect()->intended('/tutor');
        }
        elseif($user->is_tutor==0 && $user->is_student==1) //if user is registered as student redirect to /student
        {
            return redirect()->intended('/student');
        }
        elseif($user->is_admin==1) //if user is registered as admin redirect to /admin
        {
            return redirect()->intended('/admin');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
