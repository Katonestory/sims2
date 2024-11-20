<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Class name
            $table->string('stream'); // Class stream
            $table->unsignedBigInteger('class_teacher_id')->nullable(); // Make sure this column is created first
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        // Now, after the table is created, add the foreign key constraint
        Schema::table('classes', function (Blueprint $table) {
            $table->foreign('class_teacher_id')->references('id')->on('users')->onDelete('set null'); // Apply foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['class_teacher_id']); // Drop foreign key constraint if rollback
        });

        Schema::dropIfExists('classes');
    }
};
