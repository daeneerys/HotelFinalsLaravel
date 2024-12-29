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
            'deet' => "One queen bed, one sofabed, a private balcony with a jungle view, and a writing desk.",
            'roomImage1' => "images/rooms/cheetah_rest_1.webp", 
            'roomImage2' => "images/rooms/cheetah_rest_2.webp", 
            'roomImage3' => "images/rooms/cheetah_rest_3.webp" ],
            //Lion's Lair
            'Lion\'s Lair' => ['type' => 'guest', 'capacity' => 4, 'price' => 5500,
            'description' => "Feel the majestic aura of the jungle king in this regal space. Warm tones and bold accents make it a perfect haven for relaxation.", 'sqft' => '350', 
            'deet' => "One king bed, one crib, a spacious seating area, and a modern en-suite bathroom with rain shower.",
            'roomImage1' => "images/rooms/lions_lair_1.jpg", 
            'roomImage2' => "images/rooms/lions_lair_2.jpg", 
            'roomImage3' => "images/rooms/lions_lair_3.jpg" ],
            //Panther's Retreat
            'Panther\'s Retreat' => ['type' => 'guest', 'capacity' => 5, 'price' => 6000,
            'description' => "Step into a world of mystery and sophistication. This room exudes charm and offers a tranquil escape.", 
            'sqft' => '400', 
            'deet' => "One king bed, one sofabed, and a lounge area with custom jungle-themed décor.",
            'roomImage1' => "images/rooms/panther_retreat_1.jpg", 
            'roomImage2' => "images/rooms/panther_retreat_2.jpg", 
            'roomImage3' => "images/rooms/panther_retreat_3.jpg" ],
            //Jaguar's Hideaway
            'Jaguar’s Hideaway' => ['type' => 'guest', 'capacity' => 3, 'price' => 6500,
            'description' => "Immerse yourself in the jaguar's mystique. Its interiors reflect the untamed beauty of the jungle.", 
            'sqft' => '350', 
            'deet' => "One queen bed, one crib, and a cozy reading nook with jungle artwork.",
            'roomImage1' => "images/rooms/jaguar_hideaway_1.jpg", 
            'roomImage2' => "images/rooms/jaguar_hideaway_2.jpg", 
            'roomImage3' => "images/rooms/jaguar_hideaway_3.webp" ],
            //Elephant's Haven
            'Elephant\'s Haven' => ['type' => 'guest', 'capacity' => 6, 'price' => 7000,
            'description' => "This spacious room embodies the wisdom and grandeur of the mighty elephant. Ideal for families or small groups.", 
            'sqft' => '450', 
            'deet' => "Two queen beds, one sofabed, and a private terrace with outdoor seating.",
            'roomImage1' => "images/rooms/elephant_haven_1.jpg", 
            'roomImage2' => "images/rooms/elephant_have_2.jpg", 
            'roomImage3' => "images/rooms/elephant_haven_3.webp" ],
            //Giraffe's Grove
            'Giraffe’s Grove' => ['type' => 'guest', 'capacity' => 7, 'price' => 8000,
            'description' => "Reach new heights of comfort. This room, inspired by the giraffe's elegance, offers a unique blend of luxury and nature.", 
            'sqft' => '500', 
            'deet' => "Two king beds, one sofabed, and a dining table for two.",
            'roomImage1' => "images/rooms/giraffe_grove_1.jpg", 
            'roomImage2' => "images/rooms/giraffe_grove_2.jpg", 
            'roomImage3' => "images/rooms/giraffe_grove_3.jpeg" ],

            // Deluxe Rooms
            'Tigershade Suite' => ['type' => 'suite', 'capacity' => 2, 'price' => 7000,
            'description' => "Bold patterns and earthy tones make this suite a blend of energy and relaxation.", 'sqft' => '450', 
            'deet' => "One king bed, a sofabed, a luxurious en-suite with a soaking tub, and a private balcony.",
            'roomImage1' => "images/rooms/tigershade_suite_1.jpg", 
            'roomImage2' => "images/rooms/tigershade_suite_2.jpg", 
            'roomImage3' => "images/rooms/tigershade_suite_3.jpeg" ],
            //
            'Zebra\'s Oasis' => ['type' => 'suite', 'capacity' => 2, 'price' => 7500,
            'description' => "A monochrome masterpiece inspired by the zebra's beauty. Perfect for the modern traveler.", 'sqft' => '450', 
            'deet' => "One queen bed, one crib, and a walk-in closet.",
            'roomImage1' => "images/rooms/zebra_oasis_1.jpg", 
            'roomImage2' => "images/rooms/zebra_oasis_2.jpg", 
            'roomImage3' => "images/rooms/zebra_oasis_3.jpeg" ],
            //
            'Rhino’s Refuge' => ['type' => 'suite', 'capacity' => 5, 'price' => 9000,
            'description' => "Strength and tranquility define this suite. Earthy palettes and lush furnishings provide a serene experience.", 
            'sqft' => '600', 
            'deet' => "Two queen beds, one crib, and a large seating area with a wet bar.",
            'roomImage1' => "images/rooms/rhino_refuge_1.jpg", 
            'roomImage2' => "images/rooms/rhino_refuge_2.jpg", 
            'roomImage3' => "images/rooms/rhino_refuge_3.jpeg" ],
            //
            'Crocodile Cove' => ['type' => 'suite', 'capacity' => 6, 'price' => 10000,
            'description' => "Dive into the world of luxury with this spacious suite, blending modern amenities and jungle charm.", 
            'sqft' => '650', 
            'deet' => "Two king beds, one sofabed, and a dedicated workspace with jungle views.",
            'roomImage1' => "images/rooms/crocodile_cove_1.jpg", 
            'roomImage2' => "images/rooms/crocodile_cove_2.jpg", 
            'roomImage3' => "images/rooms/crocodile_cove_3.jpeg" 
            ],
            //
            'Bamboo Bungalow' => ['type' => 'suite', 'capacity' => 8, 'price' => 11000,
            'description' => "A tranquil haven surrounded by bamboo accents and calming vibes.", 'sqft' => '700', 
            'deet' => "Two king beds, one crib, and a private outdoor patio with seating.",
            'roomImage1' => "images/rooms/bamboo_1.jpg", 
            'roomImage2' => "images/rooms/bamboo_2.jpg", 
            'roomImage3' => "images/rooms/bamboo_3.jpeg" ],

            // Suites
            'The Jungle King Suite' => ['type' => 'suite', 'capacity' => 10, 'price' => 15000,
            'description' => "Live like royalty in this grand suite. The perfect combination of space, luxury, and jungle-themed elegance.", 
            'sqft' => '1000', 
            'deet' => "Two king beds, a sofabed, a spacious lounge, and a dining area for four.",
            'roomImage1' => "images/rooms/king_suite_1.jpg", 
            'roomImage2' => "images/rooms/king_suite_2.jpg", 
            'roomImage3' => "images/rooms/king_suite_3.jpeg" ],
            //
            'Rainforest Royalty Suite' => ['type' => 'suite', 'capacity' => 12, 'price' => 17000,
            'description' => "Experience unmatched luxury in this suite, with panoramic views of the jungle canopy.", 
            'sqft' => '1200', 
            'deet' => "Two queen beds, two sofabeds, a kitchenette, and a private rooftop terrace.",
            'roomImage1' => "images/rooms/royalty_suite_1.jpg", 
            'roomImage2' => "images/rooms/royalty_suite_2.jpg", 
            'roomImage3' => "images/rooms/royalty_suite_3.jpeg" ],

            // Villas
            'The Safari Villa' => ['type' => 'villa', 'capacity' => 15, 'price' => 25000,
            'description' => "A sprawling villa designed for large groups or families. Luxurious and secluded.", 'sqft' => '1500', 
            'deet' => "Three king beds, two sofabeds, a full kitchen, a private pool, and an outdoor lounge area.",
            'roomImage1' => "images/rooms/safari_1.jpg", 
            'roomImage2' => "images/rooms/safari_2.jpg", 
            'roomImage3' => "images/rooms/safari_3.jpeg" ],

            // Specialty Room
            'Treehouse Tranquility' => ['type' => 'specialty suite', 'capacity' => 2, 'price' => 30000,
            'description' => "Perched high above the ground, this treehouse offers an intimate retreat with breathtaking jungle views.", 
            'sqft' => '800', 
            'deet' => "One king bed, one sofabed, and an open-air deck with a hanging daybed.",
            'roomImage1' => "images/rooms/treehouse_1.jpg", 
            'roomImage2' => "images/rooms/treehouse_2.jpg", 
            'roomImage3' => "images/rooms/treehouse_3.jpeg" ],
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
                    'room_image_1' => $details['roomImage1'],
                    'room_image_2' => $details['roomImage2'],
                    'room_image_3' => $details['roomImage3'],
                ];
            }
        }
        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
