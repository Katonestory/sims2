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
        Schema::create('streams', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('class_id');
        $table->unsignedBigInteger('class_teacher_id')->nullable();
        $table->timestamps();

        $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        $table->foreign('class_teacher_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
};
