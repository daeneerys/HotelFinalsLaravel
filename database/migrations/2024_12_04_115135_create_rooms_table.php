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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id'); // Unique ID for each room
            $table->string('room_number')->unique();  // Unique room number (e.g., 101, 102, etc.)
            $table->string('room_name');  // Name of the room (e.g., 'Cheetah's Rest')
            $table->enum('room_type', ['guest', 'suite', 'villa', 'specialty suite', 'accessible']);  // Type of room
            $table->integer('room_size');
            $table->text('description')->nullable(); // Description of the room
            $table->integer('capacity');  // Maximum capacity of the room
            $table->decimal('price_per_night', 10, 2);  // Price per night for the room
            $table->enum('availability_status', ['available', 'booked', 'maintenance']);  // Room availability status
            $table->string('room_details');
            $table->string('room_image_1');  // URL or path for the first room image
            $table->string('room_image_2');  // URL or path for the second room image
            $table->string('room_image_3');  // URL or path for the third room image
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');  // Drop the rooms table if it exists
    }
};
