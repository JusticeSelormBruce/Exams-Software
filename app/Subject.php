<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'subjectable_id',
        'for',
        'subjectable_type'
    ];

    public function topics() {
        return $this->hasMany('App\Topic');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function usersAssigned() {
        return $this->belongsToMany('App\User')->withPivot('id');
    }

    public function subjectable() {
        return $this->morphTo();
    }

    public function exams() {
        return $this->hasMany('App\Exam');
    }
}
