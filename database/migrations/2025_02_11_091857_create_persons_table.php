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
        // Create the persons table
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_type_id')->nullable(); // Make person_type_id nullable
            $table->timestamps();
            $table->foreign('person_type_id')
                  ->references('id')
                  ->on('person_types')
                  ->onDelete('set null');  // Foreign key constraint to set NULL on delete

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('nickname');
            $table->boolean('is_adult');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
