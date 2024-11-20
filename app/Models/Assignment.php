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

    // Define the relationship with Teacher (user)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Define the relationship with Class
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id'); // Replace SchoolClass with your actual class model
    }

    // Define the relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
