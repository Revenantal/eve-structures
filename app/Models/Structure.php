<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Conduit\Conduit;
use Carbon\Carbon;
use App\Models\EVE\Type;

class Structure extends Model
{
    use SoftDeletes;
    protected $fillable =  [
        'structure_id',
        'type_id',
        'system_id',
        'profile_id',
        'reinforce_weekday',
        'reinforce_hour',
        'state',
        'services',
        'name'
    ];

    public function corporation(){
        return $this->belongsTo('App\Models\Corporation', 'corporation_id');
    }

    public function system(){
        return $this->belongsTo('App\Models\EVE\SolarSystem', 'system_id', 'system_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\EVE\Type', 'type_id', 'type_id');
    }

    public static function UpdateStructures(Corporation $corp){

        $auth = new \Conduit\Authentication(env('EVEONLINE_CLIENT_ID'), env('EVEONLINE_CLIENT_SECRET'), $corp->getRefreshToken());
        $api = new Conduit($auth);
        $apiStructures = $api->corporations($corp->corporation_id)->structures()->get()->data;

        foreach ($apiStructures as $apiStructure) {
            $structureName = Structure::removeSystemFromName($api->universe()->structures($apiStructure->structure_id)->get()->data->name);
            $structure = Structure::firstOrNew(['structure_id' => $apiStructure->structure_id]);
            $structure->structure_id = $apiStructure->structure_id;
            $structure->type_id = $apiStructure->type_id;
            $structure->corporation_id = $corp->id;
            $structure->system_id = $apiStructure->system_id;
            $structure->profile_id = $apiStructure->profile_id;
            $structure->reinforce_weekday = $apiStructure->reinforce_weekday;
            $structure->reinforce_hour = $apiStructure->reinforce_hour;
            $structure->state = $apiStructure->state;
            $structure->name = $structureName;
            $structure->updated_at = Carbon::now();
            if (isset($apiStructure->services)) {
                $structure->services = json_encode($apiStructure->services);
            }
            if (isset($apiStructure->fuel_expires)) {
                $structure->fuel_expires = new Carbon($apiStructure->fuel_expires);
            }
            $structure->save();

            // Add Type data if required
            Type::Add($structure->type_id);
        }
    }

    public function friendlyState() {
        $states = [
            "anchor_vulnerable" => "Anchoring - Vulnerable",
            "anchoring" => "Anchoring",
            "armor_reinforce" => "Armor - Reinforced",
            "armor_vulnerable" => "Armor - Vulnerable",
            "fitting_invulnerable" => "Fitting - Vulnerable",
            "hull_reinforce" => "Hull - Reinforced",
            "hull_vulnerable" => "Hull - Vulnerable",
            "online_deprecated" => "Online",
            "onlining_vulnerable" => "Onlining",
            "shield_vulnerable" => "Online",
            "unanchored" => "Unanchored",
            "unknown" => "Oh God, even CCP doesn't know!"
        ];

        return $states[$this->state];
    }

    private static function removeSystemFromName($systemName){
        $cleanedName = explode(' - ', $systemName, 2);
        return $cleanedName[1];
    }
}
