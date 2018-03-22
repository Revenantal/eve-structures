<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request, $id)
    {
        $newSettings = $this->validate($request, [
            'email' => 'email|nullable',
            'email-alerts' => 'required',
            'timezone' => 'required',
            'time-format' => 'required',
            'time-display' => 'required',
        ]);

        $user = Auth::user();
        $user->setSettings($newSettings);

        return redirect()->back()->with('success', true);
    }
}
