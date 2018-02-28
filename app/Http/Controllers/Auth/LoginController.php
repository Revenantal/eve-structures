<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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

    public function login()
    {
        try {
            return Socialite::driver('eveonline')->redirect();
        } catch (\Exception $e) {
            Log::error('Redirect to EvE Online SSO failed');
            return abort(502);
        }
    }

    public function callback()
    {
        try {
            $ssoUser = Socialite::driver('eveonline')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login');
        }

        dd($ssoUser);

    }
}
