<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'institution_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function institution() {
        return $this->belongsTo('App\Institution');
    }

    public function schools() {
        return $this->hasMany('App\School');
    }

    public function departments() {
        return $this->hasMany('App\Department');
    }

    public function subjects() {
        return $this->belongsToMany('App\Subject');
    }

    public function assignedSubjects() {
        return $this->belongsToMany('App\Subject')->withPivot('id');
    }

    public function exams() {
        return $this->hasMany('App\Exam');
    }

    public function topics() {
        return $this->hasMany('App\Topic');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }
}
