<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $fillable = ['corporation_id', 'alliance_id', 'name', 'ticker'];

    public function alliance(){
        return $this->belongsTo('App\Models\Alliance', 'alliance_id');
    }

    public function members(){
        return $this->hasMany('App\Models\Auth\User', 'corporation_id', 'id');
    }

    public function structures(){
        return $this->hasMany('App\Models\Structure', 'corporation_id', 'id');
    }
}
