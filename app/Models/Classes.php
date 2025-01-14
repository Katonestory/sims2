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
    protected $fillable = ['name', 'description'];

    public function streams()
    {
        return $this->hasMany(Streams::class);
    }


}
