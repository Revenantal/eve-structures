<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use Conduit\Conduit;
use Carbon\Carbon;

class Structure extends Model
{
    protected $fillable =  [
        'structure_id',
        'type_id',
        'system_id',
        'profile_id',
        'reinforce_weekday',
        'reinforce_hour',
        'state',
        'name'
    ];

    public function corporation(){
        return $this->belongsTo('App\Models\Corporation', 'corporation_id');
    }

    public function system(){
        return $this->belongsTo('App\Models\EVE\SolarSystem', 'system_id');
    }

    public function services(){
        return $this->hasMany('App\Models\StructureService', 'structure_id');
    }

    public static function UpdateStructures(User $user = null){
        if (!$user) {
            $user = auth()->user();
        }

        try {
            $auth = new \Conduit\Authentication(env('EVEONLINE_CLIENT_ID'), env('EVEONLINE_CLIENT_SECRET'), $user->refresh_token);
            $api = new Conduit($auth);
            $apiStructures = $api->corporations($user->corporation->corporation_id)->structures()->get()->data;

            foreach ($apiStructures as $apiStructure) {
                $structureName = $api->universe()->structures($apiStructure->structure_id)->get()->data->name;
                $structure = Structure::firstOrNew(['structure_id' => $apiStructure->structure_id]);
                $structure->structure_id = $apiStructure->structure_id;
                $structure->type_id = $apiStructure->type_id;
                $structure->corporation_id = $apiStructure->corporation_id;
                $structure->system_id = $apiStructure->system_id;
                $structure->profile_id = $apiStructure->profile_id;
                $structure->reinforce_weekday = $apiStructure->reinforce_weekday;
                $structure->reinforce_hour = $apiStructure->reinforce_hour;
                $structure->state = $apiStructure->state;
                $structure->name = $structureName;
                if (isset($apiStructure->fuel_expires)) {
                    $structure->fuel_expires = new Carbon($apiStructure->fuel_expires);
                }
                $structure->save();

                // Update services
                if (isset($apiStructure->services)) {
                    StructureService::where('structure_id', $structure->id)->delete();
                    foreach ($apiStructure->services as $apiService) {
                        $service = StructureService::firstOrNew(['name' => $apiService->name]);
                        $service->structure_id = $structure->id;
                        $service->name = $apiService->name;
                        $service->state = $apiService->state;
                        $service->save();
                    }
                }
            }
        } catch (\Exception $e) {
            abort(403, 'You do not have the required roles within your corporation.');
        }
    }
}
