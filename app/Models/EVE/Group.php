<?php

namespace App\Models\EVE;

use Illuminate\Database\Eloquent\Model;
use Conduit\Conduit;

class Group extends Model
{
    protected $fillable =  [
        'group_ID',
        'name',
        'category_id'
    ];

    static function add($group_ID) {
        $group = Group::firstOrNew(['group_ID' => $group_ID]);

        if (!$group->exists) {
            $api = new Conduit();
            $apiType = $api->universe()->groups($group_ID)->get();

            $group->group_ID = $apiType->group_id;
            $group->name = $apiType->name;
            $group->category_id = $apiType->category_id;

            $group->save();
        }
    }

    //TODO: eventually make this controllable by the user.
    public function cssColor() {

        switch ($this->name) {
            case "Engineering Complex":
                return "yellow";
            break;
            case "Citadel":
                return "red";
            break;

            case "Refinery":
                return "green";
            break;
        }
    }

    //TODO: eventually make this controllable by the user.
    public function faIcon() {

        switch ($this->name) {
            case "Engineering Complex":
                return "fa-industry";
                break;
            case "Citadel":
                return "fa-shield";
                break;

            case "Refinery":
                return "fa-gears";
                break;
        }
    }
}
