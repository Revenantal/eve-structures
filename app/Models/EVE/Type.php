<?php

namespace App\Models\EVE;

use Illuminate\Database\Eloquent\Model;
use Conduit\Conduit;

class Type extends Model
{
    protected $fillable =  [
        'type_id',
        'name',
        'description',
        'group_id'
    ];

    static function add($type_ID) {
        $type = Type::firstOrNew(['type_id' => $type_ID]);

        if (!$type->exists) {
            $api = new Conduit();
            $apiType = $api->universe()->types($type_ID)->get();

            $type->type_id = $apiType->type_id;
            $type->name = $apiType->name;
            $type->description = $apiType->description;
            $type->group_id = $apiType->group_id;

            $type->save();
        }
    }
}
