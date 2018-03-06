<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\Auth\User;
use App\Models\Corporation;
use App\Models\Alliance;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Socialite;
use Conduit\Conduit;

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
            return Socialite::driver('eveonline')
                ->scopes(['esi-corporations.read_structures.v1',
                          'esi-universe.read_structures.v1'])
                ->redirect();
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


        //TODO: Add handler for same corp, different alliance

        // Get character details
        $api = new Conduit();
        $apiCharacter = $api->characters($ssoUser->id)->get();

        $corporation = Corporation::firstOrNew(['corporation_id' => $apiCharacter->corporation_id]);

        if (isset($apiCharacter->data->alliance_id)) {
            $alliance = Alliance::firstOrNew(['alliance_id' => $apiCharacter->alliance_id]);
            if(!$alliance->exists) {
                $apiAlliance = $api->alliances($apiCharacter->alliance_id)->get();
                $alliance->alliance_id = $apiCharacter->alliance_id;
                $alliance->name = $apiAlliance->name;
                $alliance->ticker = $apiAlliance->ticker;
                $alliance->save();
            }

            // Update Corporation if it already exists and they changed alliances
            if ($corporation->exists && $corporation->alliance_id != $alliance->id) {
                $corporation->alliance_id = $alliance->id;
                $corporation->save();
            }
        }

        // Update Corporation
        if(!$corporation->exists) {
            $apiCorporation = $api->corporations($apiCharacter->corporation_id)->get();
            $corporation->corporation_id = $apiCharacter->corporation_id;
            $corporation->name = $apiCorporation->name;
            $corporation->ticker = $apiCorporation->ticker;
            if (isset($alliance)) { $corporation->alliance_id = $alliance->id; }
            $corporation->save();
        }

        // Get or Create User
        $user = User::firstOrNew(['character_id' => $ssoUser->id]);
        // And then update the data in case something changed
        $user->character_id = $ssoUser->id;
        $user->character_name = $apiCharacter->name;
        $user->refresh_token = $ssoUser->refreshToken;
        $user->corporation_id = $corporation->id;
        if (isset($alliance)) { $user->alliance_id = $alliance->id; }
        $user->save();

      /*  $auth = new \Conduit\Authentication(env('EVEONLINE_CLIENT_ID'), env('EVEONLINE_CLIENT_SECRET'), $ssoUser->refreshToken);
        $api = new Conduit($auth);
        $structures = $api->corporations($character->corporation_id)->structures()->get()->data;
        dd($structures);
        dd($api->universe()->structures($structures[0]->structure_id)->get()->data);
*/
        // and then log in
        Auth::login($user, true);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
