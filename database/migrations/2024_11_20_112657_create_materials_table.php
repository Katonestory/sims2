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
        Schema::create('materials', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the material
            $table->unsignedBigInteger('teacher_id'); // Foreign key for the teacher who uploaded the material
            $table->unsignedBigInteger('class_id')->nullable(); // Foreign key for the associated class
            $table->unsignedBigInteger('subject_id'); // Foreign key for the associated subject
            $table->text('description')->nullable(); // Material description
            $table->string('filepath'); // Path to the uploaded file
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        // Add foreign key constraints
        Schema::table('materials', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade'); // Teacher must exist in users
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null'); // Class association
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade'); // Subject association
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['subject_id']);
        });

        Schema::dropIfExists('materials');
    }
};
