<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('opening_time_id'); // Foreign key to 'opening_times' table
            $table->string('unit'); // Example: "hour", "day", etc.
            $table->decimal('price', 8, 2); // Price for the rate
            $table->timestamps(); // Includes 'created_at' and 'updated_at'

            // Foreign key constraint
            $table->foreign('opening_time_id')->references('id')->on('opening_times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
