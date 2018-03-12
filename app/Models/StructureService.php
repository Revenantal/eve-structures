<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructureService extends Model
{
    protected $fillable =  [
        'structure_id',
        'name',
        'state'
    ];

    public function structure(){
        return $this->belongsTo('App\Models\Structure', 'structure_id');
    }
}
