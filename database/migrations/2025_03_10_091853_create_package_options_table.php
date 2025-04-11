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
        Schema::create('package_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();  // This will automatically create 'created_at' and 'updated_at' columns
            $table->boolean('is_active')->default(true);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_options');
    }
};
