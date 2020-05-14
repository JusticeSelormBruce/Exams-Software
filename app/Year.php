<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'name',
        'for',
        'system_id'
    ];

    public function system() {
        return $this->belongsTo('App\System');
    }

    public function topics() {
        return $this->hasMany('App\Topic');
    }
}
