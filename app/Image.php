<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'url',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
