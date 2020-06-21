<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subject extends Model
{


    protected $fillable = [
        'name', 'description', 'code', 'credit'
    ];

    use Notifiable,SoftDeletes;
    
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}


