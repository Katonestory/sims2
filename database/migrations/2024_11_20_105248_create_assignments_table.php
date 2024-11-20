<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the assignment
            $table->unsignedBigInteger('teacher_id'); // Foreign key referencing teachers
            $table->unsignedBigInteger('class_id'); // Foreign key referencing classes
            $table->unsignedBigInteger('subject_id'); // Foreign key referencing subjects
            $table->text('description')->nullable(); // Optional description
            $table->string('filepath')->nullable(); // Path to the uploaded assignment file
            $table->date('dueDate'); // Due date for the assignment
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        // Add foreign key constraints
        Schema::table('assignments', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade'); // Assuming teachers are in users table
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['subject_id']);
        });

        Schema::dropIfExists('assignments');
    }
};
