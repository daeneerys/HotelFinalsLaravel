<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roomTypes = [
            // Standard Rooms
            //Cheetah's Rest
            'Cheetah\'s Rest' => ['type' => 'guest', 'capacity' => 3, 'price' => 5000, 
            'description' => "Experience the sleek elegance of the savannah in this cozy retreat. 
            Inspired by the cheetah's speed and grace, this room blends comfort with minimalistic luxury.", 'sqft' => '300', 
            'deet' => "One queen bed, one sofabed, a private balcony with a jungle view, and a writing desk."],
            //Lion's Lair
            'Lion\'s Lair' => ['type' => 'guest', 'capacity' => 4, 'price' => 5500,
            'description' => "Feel the majestic aura of the jungle king in this regal space. Warm tones and bold accents make it a perfect haven for relaxation.", 'sqft' => '350', 
            'deet' => "One king bed, one crib, a spacious seating area, and a modern en-suite bathroom with rain shower."],
            //Panther's Retreat
            'Panther\'s Retreat' => ['type' => 'guest', 'capacity' => 5, 'price' => 6000,
            'description' => "Step into a world of mystery and sophistication. This room exudes charm and offers a tranquil escape.", 
            'sqft' => '400', 
            'deet' => "One king bed, one sofabed, and a lounge area with custom jungle-themed décor."],
            //Jaguar's Hideaway
            'Jaguar’s Hideaway' => ['type' => 'guest', 'capacity' => 3, 'price' => 6500,
            'description' => "Immerse yourself in the jaguar's mystique. Its interiors reflect the untamed beauty of the jungle.", 
            'sqft' => '350', 
            'deet' => "One queen bed, one crib, and a cozy reading nook with jungle artwork."],
            //Elephant's Haven
            'Elephant\'s Haven' => ['type' => 'guest', 'capacity' => 6, 'price' => 7000,
            'description' => "This spacious room embodies the wisdom and grandeur of the mighty elephant. Ideal for families or small groups.", 
            'sqft' => '450', 
            'deet' => "Two queen beds, one sofabed, and a private terrace with outdoor seating."],
            //Giraffe's Grove
            'Giraffe’s Grove' => ['type' => 'guest', 'capacity' => 7, 'price' => 8000,
            'description' => "Reach new heights of comfort. This room, inspired by the giraffe's elegance, offers a unique blend of luxury and nature.", 
            'sqft' => '500', 
            'deet' => "Two king beds, one sofabed, and a dining table for two."],

            // Deluxe Rooms
            'Tigershade Suite' => ['type' => 'suite', 'capacity' => 2, 'price' => 7000,
            'description' => "Bold patterns and earthy tones make this suite a blend of energy and relaxation.", 'sqft' => '450', 
            'deet' => "One king bed, a sofabed, a luxurious en-suite with a soaking tub, and a private balcony."],
            //
            'Zebra\'s Oasis' => ['type' => 'suite', 'capacity' => 2, 'price' => 7500,
            'description' => "A monochrome masterpiece inspired by the zebra's beauty. Perfect for the modern traveler.", 'sqft' => '450', 
            'deet' => "One queen bed, one crib, and a walk-in closet."],
            //
            'Rhino’s Refuge' => ['type' => 'suite', 'capacity' => 5, 'price' => 9000,
            'description' => "Strength and tranquility define this suite. Earthy palettes and lush furnishings provide a serene experience.", 
            'sqft' => '600', 
            'deet' => "Two queen beds, one crib, and a large seating area with a wet bar."],
            //
            'Crocodile Cove' => ['type' => 'suite', 'capacity' => 6, 'price' => 10000,
            'description' => "Dive into the world of luxury with this spacious suite, blending modern amenities and jungle charm.", 
            'sqft' => '650', 
            'deet' => "Two king beds, one sofabed, and a dedicated workspace with jungle views."],
            //
            'Bamboo Bungalow' => ['type' => 'suite', 'capacity' => 8, 'price' => 11000,
            'description' => "A tranquil haven surrounded by bamboo accents and calming vibes.", 'sqft' => '700', 
            'deet' => "Two king beds, one crib, and a private outdoor patio with seating."],

            // Suites
            'The Jungle King Suite' => ['type' => 'suite', 'capacity' => 10, 'price' => 15000,
            'description' => "Live like royalty in this grand suite. The perfect combination of space, luxury, and jungle-themed elegance.", 
            'sqft' => '1000', 
            'deet' => "Two king beds, a sofabed, a spacious lounge, and a dining area for four."],
            //
            'Rainforest Royalty Suite' => ['type' => 'suite', 'capacity' => 12, 'price' => 17000,
            'description' => "Experience unmatched luxury in this suite, with panoramic views of the jungle canopy.", 
            'sqft' => '1200', 
            'deet' => "Two queen beds, two sofabeds, a kitchenette, and a private rooftop terrace."],

            // Villas
            'The Safari Villa' => ['type' => 'villa', 'capacity' => 15, 'price' => 25000,
            'description' => "A sprawling villa designed for large groups or families. Luxurious and secluded.", 'sqft' => '1500', 
            'deet' => "Three king beds, two sofabeds, a full kitchen, a private pool, and an outdoor lounge area."],

            // Specialty Room
            'Treehouse Tranquility' => ['type' => 'specialty suite', 'capacity' => 2, 'price' => 30000,
            'description' => "Perched high above the ground, this treehouse offers an intimate retreat with breathtaking jungle views.", 
            'sqft' => '800', 
            'deet' => "One king bed, one sofabed, and an open-air deck with a hanging daybed."],
        ];

        $rooms = [];
        $roomNumber = 101; // Start room numbering from 101

        foreach ($roomTypes as $roomName => $details) {
            for ($i = 1; $i <= 3; $i++) {
                $rooms[] = [
                    'room_number' => $roomNumber++,
                    'room_name' => $roomName,
                    'room_type' => $details['type'],
                    'room_size' => $details['sqft'],
                    'description' => $details['description'],
                    'capacity' => $details['capacity'],
                    'price_per_night' => $details['price'],
                    'availability_status' => 'available',
                    'room_details' => $details['deet'],
                    'room_image_1' => 'images/rooms/image_1.jpg',
                    'room_image_2' => 'images/rooms/image_1.jpg',
                    'room_image_3' => 'images/rooms/image_1.jpg',
                ];
            }
        }
        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
