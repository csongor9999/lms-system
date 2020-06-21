<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{

    protected $fillable = [
        'rating_point','rating_text'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
