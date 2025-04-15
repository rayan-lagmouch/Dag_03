<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Add the email column to the contacts table
            $table->string('email')->nullable();  // Add a nullable email column
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Rollback: remove the email column if necessary
            $table->dropColumn('email');
        });
    }
}
