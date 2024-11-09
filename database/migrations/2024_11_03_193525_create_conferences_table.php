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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->string('time'); // Storing time as a string to allow a range like "09:00 - 17:00"
            $table->json('location')->nullable(); // To store location data as JSON
            $table->json('speakers')->nullable(); // Speakers stored as JSON array
            $table->json('agendas')->nullable();  // Agendas stored as JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
