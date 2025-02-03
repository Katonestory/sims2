<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    use HasFactory;
    protected $table ='parent_student';
    protected $fillable =['parent_id','student_id'];
}
