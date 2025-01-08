<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
        'address',
        'hireDate',
        'status',
        'photoPath',

    ];

      /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
        'DoB' => 'date',
        'hireDate' => 'date',
    ];

    /**
     * Define the relationship with the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Automatically update the 'name' field in the User model
     * when a Teacher record is created or updated.
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($teacher) {
            if ($teacher->user) {
                $teacher->user->name = $teacher->first_name . ' ' . $teacher->surname;
                $teacher->user->save();
            }
        });
    }
}
