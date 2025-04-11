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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_hours');
            $table->integer('num_adults');
            $table->integer('num_children')->nullable();
            $table->string('reservation_code', 20);
            $table->string('status', 30);
            $table->unsignedBigInteger('opening_time_id');
            $table->unsignedBigInteger('lane_id');
            $table->unsignedBigInteger('package_option_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
