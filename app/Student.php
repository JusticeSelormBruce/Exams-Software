<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable =[
        'other_names',
        'last_name'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
}
