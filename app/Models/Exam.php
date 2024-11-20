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

    // Define the relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Define the relationship with Class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Adjust the model name if needed
    }
}
