<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id'); // Primary Key
            $table->foreignId('user_id')
                  ->constrained('users') // References 'id' in 'users' table
                  ->onDelete('cascade'); // Cascade delete on user deletion
        
            $table->unsignedBigInteger('room_id'); // Foreign key to rooms table
            $table->foreign('room_id')
                  ->references('room_id') // References 'room_id' in rooms table
                  ->on('rooms')
                  ->onDelete('cascade'); // Cascade delete on room deletion
        
            $table->unsignedBigInteger('amenity_id'); // Foreign key to amenities table
            $table->foreign('amenity_id')
                  ->references('amenity_id') // References 'amenity_id' in amenities table
                  ->on('amenities')
                  ->onDelete('cascade'); // Cascade delete on amenity deletion
        
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->decimal('total_price', 10, 2); // Total price for the reservation
            $table->string('reservation_status', 50); // Example: Pending, Confirmed, Cancelled
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
