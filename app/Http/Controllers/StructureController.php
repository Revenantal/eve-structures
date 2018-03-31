<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\EVE\SolarSystem;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structures = Auth::user()->getStructures()->sortBy('fuel_expires');
        $data['structures'] = $structures;
        $data['regions'] = [];
        $data['systems'] = [];
        $data['corporations'] = [];
        $data['alliances'] = [];
        $data['groups'] = [];
        $data['types'] = [];



        foreach ($structures as $structure) {

            if (!in_array($structure->system->region, $data['regions'])) {
                $data['regions'][] = $structure->system->region;
            }

            if (!in_array($structure->system, $data['systems'])) {
                $data['systems'][] = $structure->system;
            }

            if (!in_array($structure->corporation, $data['corporations'])) {
                $data['corporations'][] = $structure->corporation;
            }

            if (!in_array($structure->corporation->alliance, $data['alliances'])) {
                $data['alliances'][] = $structure->corporation->alliance;
            }

            if (!in_array($structure->type, $data['groups'])) {
                $data['groups'][] = $structure->type->group;
            }

            if (!in_array($structure->type, $data['types'])) {
                $data['types'][] = $structure->type;
            }
        }

        $data['regions'] = collect($data['regions'])->sortBy('name')->unique();
        $data['systems'] = collect($data['systems'])->sortBy('name')->unique();
        $data['corporations'] = collect($data['corporations'])->sortBy('name')->unique();
        $data['alliances'] = collect($data['alliances'])->sortBy('name')->unique();
        $data['groups'] = collect($data['groups'])->sortBy('name')->unique();
        $data['types'] = collect($data['types'])->sortBy('name')->unique();

        return view('structures', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd(Auth::user()->getStructures());

        $structure = Auth::user()->getStructures()->firstWhere('structure_id', $id);

        if ($structure) {
            $data['structure'] = $structure;
            $data['services'] = json_decode($data['structure']->services);
            return view('single-structure', $data);
        } else {
            dd ('Did I say you can view this? Go away spy.');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
