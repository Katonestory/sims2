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
        $table->id();
        $table->string('title');
        $table->unsignedBigInteger('subject_id');
        $table->unsignedBigInteger('class_id');
        $table->date('exam_date');
        $table->string('academic_year');
        $table->timestamps();

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
        Schema::dropIfExists('exams');
    }
};
