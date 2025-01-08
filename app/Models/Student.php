<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'surname',
        'DoB',
        'gender',
        'email',
        'phone_number',
        'student_id',
        'address',
        'class_id',
        'stream_id',
        'status',
        'photoPath',
    ];

    /**
     * Define the relationship with the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // A student belongs to a user
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class, 'stream_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    /**
     * Automatically update the 'name' field in the User model
     * when a Student record is created or updated.
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($student) {
            if ($student->user) {
                $student->user->name = $student->first_name . ' ' . $student->surname;
                $student->user->save();
            }
        });
    }
}
