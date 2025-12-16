<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    
    protected $fillable = [
        'name',
        'description',
        'instructor',
        'schedule',
        'capacity',
        'image',
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id')->withTimestamps();
    }
}
