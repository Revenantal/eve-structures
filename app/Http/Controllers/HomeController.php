<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EVE\Group;
use App\Models\Structure;
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

        $structures = Auth::user()->getStructures();
        $data['structureTypes'] = [];
        $data['structureGroups'] = [];
        $data['structureFuelStatus'] = ['Online' => 0, 'Low Power' => 0];

        // gather a count of all the structure types and counts, as well as groups and counts.
        foreach ($structures as $structure) {
            if (isset($data['structureTypes'][$structure->type->name])) {
                $data['structureTypes'][$structure->type->name]++;
            } else {
                $data['structureTypes'][$structure->type->name] = 1;
            }

            if (isset($data['structureGroups'][$structure->type->group->name])) {
                $data['structureGroups'][$structure->type->group->name]++;
            } else {
                $data['structureGroups'][$structure->type->group->name] = 1;
            }

            if (isset($structure->fuel_expires)) {
                $data['structureFuelStatus']['Online']++;
            } else {
                $data['structureFuelStatus']['Low Power']++;
            }
        }

        $data['upcomingStructures'] = Auth::user()->corporation->structures
            ->filter(function($structure){
                return $structure->fuel_expires != '';})
            ->sortBy('fuel_expires')
            ->take(5);

        return view('home', $data);
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