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
    Schema::create('properties', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('city')->nullable();
        $table->string('type')->nullable(); // Apartment/House/Penthouse/etc.
        $table->unsignedInteger('price')->nullable();
        $table->string('image')->nullable();
        $table->text('description')->nullable();
        $table->unsignedBigInteger('agent_id')->nullable(); // No constraint yet
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
