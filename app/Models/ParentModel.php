<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table ='parents';
    protected $fillable =['user_id','phone_number'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function student(){
        return $this->belongsToMany(Student::class, 'parent_student','parent_id','student_id');
    }
}
