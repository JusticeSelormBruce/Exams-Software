<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExamLog extends Model
{
        protected $fillable = [
        'exam_id',
        'student_id',
        'objectives_id'
    ];
}
