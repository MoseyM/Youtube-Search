<?php

namespace App\Http\Controllers\Auth;

use \Illuminate\Http\Request;
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

    /**
     * {@inheritdoc}
     */
    protected function sendLoginResponse(Request $request)
    {
        //Overriding 5 year time for currently queued cookie if user selected to remember user
        if($request->filled('remember')) {
            //Retrieve the cookie name in queue
            $currentRecallerName = $this->guard()->getRecallerName();
            //Set new expiry time for cookie (20160 mins or 2 weeks)
            $expiryCookieTime = 20160;
            //Update the existing cookie in queue with new expiry time
            $updatedCookie = $this->guard()->getCookieJar()->getQueuedCookies()[$currentRecallerName];
            $this->guard()->getCookieJar()->queue($currentRecallerName, $updatedCookie->getValue(), $expiryCookieTime);
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }}
