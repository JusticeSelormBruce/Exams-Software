<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'institution_id',
        'system_id'
    ];

    public function institution() {
        return $this->belongsTo('App\Institution');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function departments() {
        return $this->hasMany('App\Department');
    }

    public function system() {
        return $this->belongsTo('App\System');
    }

    public function subjects() {
        return $this->morphMany('App\Subject', 'subjectable');
    }
}
