<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable =[
        'name',
        'subject_id',
        'year_id',
        'term_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }

    public function term() {
        return $this->belongsTo('App\Term');
    }

    public function year() {
        return $this->belongsTo('App\Year');
    }

    public function objectives() {
        return $this->hasMany('App\Objective');
    }

    public function theories() {
        return $this->hasMany('App\Theory');
    }
}
