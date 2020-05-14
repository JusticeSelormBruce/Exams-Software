<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'user_id',
        'type',
        'system_id'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function system() {
        return $this->belongsTo('App\System');
    }

    public function schools() {
        return $this->hasMany('App\School');
    }

    public function subjects() {
        return $this->morphMany('App\Subject', 'subjectable');
    }

}
