<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'name','description','point','task_start','task_end'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
}
