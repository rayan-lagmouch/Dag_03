<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 50);
        $table->string('middle_name', 50)->nullable();
        $table->string('last_name', 50);
        $table->string('nickname', 50)->nullable();
        $table->boolean('is_adult');
        $table->unsignedBigInteger('person_type_id');
        $table->timestamps();
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
