<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teacher_id',
        'class_id',
        'subject_id',
        'description',
        'filepath',
    ];

    // Define the relationship with User (Teacher)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Define the relationship with Class
    public function class()
    {
        return $this->belongsTo(Classe::class, 'class_id'); // Ensure class model uses `Classe` to match naming conventions
    }

    // Define the relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
