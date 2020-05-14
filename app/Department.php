<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'school_id'
    ];

    public function school() {
        return $this->belongsTo('App\School');
    }

    public function subjects() {
        return $this->morphMany('App\Subject', 'subjectable');
    }
}
