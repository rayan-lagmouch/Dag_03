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
            $table->foreignId('person_id')->constrained('people');
            $table->foreignId('opening_hour_id')->constrained('opening_hours');
            $table->foreignId('lane_id')->constrained('lanes');
            $table->foreignId('package_option_id')->nullable()->constrained('package_options');
            $table->foreignId('reservation_status_id')->constrained('reservation_statuses');
            $table->string('reservation_number')->unique();
            $table->date('date');
            $table->integer('hours');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();

            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
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
