<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id'); // Add this column
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade'); // Foreign key constraint
            $table->string('mobile')->nullable();  // Mobile column
            $table->string('email')->nullable();   // Email column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
