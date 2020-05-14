<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectUser extends Model
{
    protected $table = 'subject_user';

    protected $fillable = [
        'subject_id',
        'user_id'
    ];
}
