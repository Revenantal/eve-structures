<?php

namespace App\Models\EVE;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = false;

    public function systems()
    {
        return $this->hasMany('App\Models\EVE\SolarSystem', 'region_id', 'id');
    }
}