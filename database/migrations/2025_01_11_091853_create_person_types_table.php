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
        Schema::create('person_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // 👈 this must be here

        });
    }
    



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_types');
    }
};
