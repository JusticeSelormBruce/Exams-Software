<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'for'
    ];

    public function schools() {
        return $this->hasMany('App\School');
    }

    public function institutions() {
        return $this->hasMany('App\Institution');
    }

    public function years() {
        return $this->hasMany('App\Year');
    }

    public function terms() {
        return $this->hasMany('App\Term');
    }

    public function subjects() {
        return $this->morphMany('App\Subject', 'subjectable');
    }

}
