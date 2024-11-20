<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Links to the users table
            $table->string('phone_number'); // Teacher's phone number
            $table->enum('status', ['active', 'inactive']); // Teacher's status (active or inactive)
            $table->date('hire_date'); // Date when the teacher was hired
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
