<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StructureService extends Model
{
    use SoftDeletes;
    protected $fillable =  [
        'structure_id',
        'name',
        'state'
    ];

    public function structure(){
        return $this->belongsTo('App\Models\Structure', 'structure_id');
    }
}
