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
        $table->id();
        $table->string('title');
        $table->unsignedBigInteger('teacher_id');
        $table->unsignedBigInteger('class_id');
        $table->unsignedBigInteger('subject_id');
        $table->text('description')->nullable();
        $table->string('filepath');
        $table->date('dueDate');
        $table->timestamps();

        $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
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
        Schema::dropIfExists('assignments');
    }
};
