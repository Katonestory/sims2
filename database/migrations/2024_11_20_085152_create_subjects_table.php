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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Subject name
            $table->string('code');  // Subject code (e.g., MTH101)
            $table->text('description');  // Subject description
            $table->unsignedBigInteger('department_id');  // Foreign key for department
            $table->integer('credits');  // Number of credits for the subject
            $table->tinyInteger('status')->default(1);  // 1 = active, 0 = inactive
            $table->timestamps();

            // Define foreign key relationship to the departments table
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
