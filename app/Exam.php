<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
      'header',
      'section_a',
      'section_b',
      'user_id',
      'subject_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subject() {
        return$this->belongsTo('App\Subject');
    }
}
