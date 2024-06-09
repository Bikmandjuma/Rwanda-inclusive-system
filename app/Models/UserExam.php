<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable=[
        'UserId',
        'ExamId',
        'CompletedDate',
        'Passed',
    ];

    public function get_user_id(){
        $this->hasMany('App\Models\User','UserId');
    }

    public function get_exam_id(){
        $this->hasMany('App\Models\Exam','ExamId');
    }

}
