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
            $table->foreignId('person_id')->constrained('persons');
            $table->foreignId('opening_time_id')->constrained('opening_times');
            $table->foreignId('lane_id')->constrained('lanes');
            $table->foreignId('package_option_id')->nullable()->constrained('package_options');
            $table->unsignedTinyInteger('reservation_status');
            $table->string('reservation_number');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_hours');
            $table->unsignedInteger('num_adults')->nullable();
            $table->unsignedInteger('num_children')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('comment')->nullable();
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
