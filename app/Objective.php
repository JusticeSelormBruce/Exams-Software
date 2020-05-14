<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'e',
        'answer',
        'difficulty',
        'user_id'
    ];

    public function topic() {
        return $this->belongsTo('App\Topic');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
