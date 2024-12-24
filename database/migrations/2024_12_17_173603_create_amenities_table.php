<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id('amenity_id');  // Primary key
            $table->string('amenity_name');  // Name of the amenity
            $table->text('description');  // Description of the amenity
            $table->decimal('price_per_use', 8, 2);  // Price for using the amenity
            $table->string('image_path');
            $table->timestamps();  // For created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenities');
    }
}
