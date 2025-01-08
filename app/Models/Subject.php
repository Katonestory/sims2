<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'code',
        'description',
        'department_id',
        'credits',
        'status',
    ];



    // If needed, define other relationships such as for 'department_id'
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
