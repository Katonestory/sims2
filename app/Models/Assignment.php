<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teacher_id',
        'class_id',
        'subject_id',
        'description',
        'filepath',
        'dueDate',
    ];


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function assignedClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function thisteacher()
{
    // Assuming the teacher's details are stored in the 'teachers' table
    return $this->belongsTo(Teacher::class, 'teacher_id');
}
}
