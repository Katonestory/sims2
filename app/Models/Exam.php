<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'class_id',
        'exam_date',
        'academic_year',
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }


    public function results()
    {
        return $this->hasMany(Result::class);
    }

}
