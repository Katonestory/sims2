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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the announcement
            $table->text('message'); // Message content
            $table->unsignedBigInteger('created_by'); // Foreign key for user who created the announcement
            $table->date('startDate'); // Start date for announcement visibility
            $table->date('endDate')->nullable(); // Optional end date for announcement visibility
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        // Add foreign key constraints
        Schema::table('announcements', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Assuming creators are in users table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::dropIfExists('announcements');
    }
};
