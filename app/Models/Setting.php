<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    protected $fillable = ['name','value'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User', 'id');
    }

}
