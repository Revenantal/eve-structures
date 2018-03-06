<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
    protected $fillable = ['alliance_id', 'name', 'ticker'];

    public function corporations(){
        return $this->hasMany('App\Models\Corporation', 'alliance_id', 'id');
    }

    public function members(){
        return $this->hasMany('App\Models\Auth\User', 'alliance_id', 'id');
    }
}
