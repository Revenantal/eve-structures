<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EVE\Group;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function calendar()
    {
        $data['structureGroups'] = Group::where('category_id', 65)->orderBy('name', 'asc')->get();

        $data['upcomingStructures'] = Auth::user()->corporation->structures
            ->filter(function($structure){
                return $structure->fuel_expires != '';})
            ->sortBy('fuel_expires')
            ->take(10);

        return view('calendar', $data);
    }

    public function table()
    {
        return view('table');
    }
}