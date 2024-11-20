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
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Exam title
            $table->unsignedBigInteger('subject_id'); // Foreign key referencing subjects table
            $table->unsignedBigInteger('class_id'); // Foreign key referencing classes table
            $table->dateTime('exam_date'); // Exam date and time
            $table->string('academic_year'); // Academic year of the exam
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        // Add foreign key constraints
        Schema::table('exams', function (Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['class_id']);
        });

        Schema::dropIfExists('exams');
    }
};
