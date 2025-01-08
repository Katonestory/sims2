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
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('first_name');
        $table->string('middle_name')->nullable();
        $table->string('surname');
        $table->date('DoB');
        $table->string('gender');
        $table->string('email')->unique();
        $table->string('phone_number');
        $table->string('student_id')->nullable();
        $table->text('address');
        $table->unsignedBigInteger('class_id')->nullable();
        $table->unsignedBigInteger('stream_id')->nullable();
        $table->tinyInteger('status')->default(1);
        $table->string('photoPath')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
        $table->foreign('stream_id')->references('id')->on('streams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
