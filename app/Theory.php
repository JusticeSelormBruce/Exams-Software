<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    protected $table = 'theories'; 
    
    protected $fillable = [
        'question',
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
