<?php

namespace App\Models\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\User\UserSettingTrait;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use UserSettingTrait;

    /**
     * Attributes that should be filled in
     *
     * @var array
     */
    protected $fillable = [
        'character_id',
        'character_name',
        'corporation_id',
        'alliance_id',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function corporation(){
        return $this->belongsTo('App\Models\Corporation', 'corporation_id');
    }

    public function alliance(){
        return $this->belongsTo('App\Models\Alliance', 'alliance_id');
    }

    public function setting()
    {
        return $this->hasMany('App\Models\Setting', 'user_id');
    }

}