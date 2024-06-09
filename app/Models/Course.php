<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'description'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course');
    }
}
