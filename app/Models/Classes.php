<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    // Specify the table if it's not following Laravel's naming convention
    protected $table = 'classes';

    // Specify the fields that can be mass-assigned
    protected $fillable = ['name', 'stream', 'class_teacher_id'];

    // Define relationships, for example, with teachers
    public function teacher()
    {
        return $this->belongsTo(User::class, 'class_teacher_id');
    }

    // You can also add a method for students if needed
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
