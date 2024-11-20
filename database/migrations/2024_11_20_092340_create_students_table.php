<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('student_id')->unique();
            $table->date('DoB');
            $table->string('gender');
            $table->text('address');
            $table->unsignedBigInteger('class_id')->nullable(); // Foreign key to the classes table
            $table->tinyInteger('status')->default(1);
            $table->string('photoPath')->nullable();
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
