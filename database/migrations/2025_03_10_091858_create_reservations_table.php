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

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons')->onDelete('cascade');
            $table->foreignId('opening_time_id')->constrained('opening_times')->onDelete('cascade');
            $table->foreignId('lane_id')->constrained('lanes')->onDelete('cascade');
            $table->foreignId('package_option_id')->constrained('package_options')->onDelete('cascade');
            $table->foreignId('reservation_status_id')->constrained('reservation_statuses')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('adult_count');
            $table->integer('child_count')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(true);
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
