<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'attendance';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'student_id',
        'date',
        'status',
        'remarks',
    ];

    /**
     * Relationship: An attendance record belongs to a student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
