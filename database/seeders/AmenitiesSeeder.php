<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenities;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert amenities
        Amenities::create([
            'amenity_name' => 'Treetop Feast',
            'description' => 'A breathtaking retreat among the treetops, Treetop Feast offers a dining experience like no other. 
            Perched high above the jungle floor, it is an enchanting sanctuary where nature and elegance meet.',
            'price_per_use' => 4500.00,
            'image_path' => 'images/amenities/treetop_feast.webp',
        ]);

        Amenities::create([
            'amenity_name' => 'The Wild Orchid',
            'description' => 'A hidden gem deep in the heart of the jungle, The Wild Orchid is a sanctuary of elegance and serenity. 
            Surrounded by vibrant tropical blooms and lush greenery, 
            it is a haven to return to—a celebration of nature’s beauty and flavors.',
            'price_per_use' => 3800.00,
            'image_path' => 'images/amenities/wild_orchid.webp',
        ]);

        Amenities::create([
            'amenity_name' => 'Vines and Views',
            'description' => 'An open-air terrace surrounded by cascading greenery, 
            Vines and Views offers a dining experience immersed in nature’s splendor. 
            Perched above a tranquil river with breathtaking jungle vistas, it is a space to linger and savor.',
            'price_per_use' => 3200.00,
            'image_path' => 'images/amenities/vines_and_views.webp',
        ]);

        Amenities::create([
            'amenity_name' => 'Mist and Mango',
            'description' => 'A cozy café tucked within the jungle’s heart, Mist and Mango is a delightful escape where the aroma of 
            freshly brewed coffee mingles with the scent of tropical fruits. Surrounded by lush greenery and kissed by 
            the soft river mist, it’s the perfect spot to enjoy vibrant flavors, refreshing drinks, and warm conversations.',
            'price_per_use' => 2500.00,
            'image_path' => 'images/amenities/mist_and_mango.webp',
        ]);

        Amenities::create([
            'amenity_name' => 'Wildleaf Dining',
            'description' => 'An enchanting dining destination, Wildleaf Dining 
            is where the beauty of the jungle meets the art of fine cuisine. 
            Surrounded by lush greenery and immersed in the tranquil sounds of nature, 
            it offers a refined yet immersive experience. Every dish celebrates fresh, locally sourced ingredients, 
            bringing the essence of the wild to your plate.',
            'price_per_use' => 3000.00,
            'image_path' => 'images/amenities/wildleafdining.webp',
        ]);
        Amenities::create([
            'amenity_name' => 'Riverside Infinity Pool with Jungle Views',
            'description' => 'Relax and rejuvenate at our stunning riverside infinity pool, 
            where the serene waters merge seamlessly with breathtaking jungle vistas. 
            Immerse yourself in the tranquil ambiance as you soak up panoramic views of lush greenery and the gentle flow of the river.',
            'price_per_use' => 00.00,
            'image_path' => 'images/amenities/amenities_pool.webp',
        ]);
        Amenities::create([
            'amenity_name' => 'Private Nature Trails and Jungle Safaris',
            'description' => 'Wander through lush, verdant pathways alive with the sights and sounds of exotic wildlife, 
            or embark on a safari led by expert guides who reveal the secrets of the jungle. 
            Perfect for adventurers and nature enthusiasts, these experiences blend exploration and tranquility 
            for unforgettable moments in our serene jungle paradise.',
            'price_per_use' => 2000.00,
            'image_path' => 'images/amenities/amenities_trail.jpg',
        ]);
        Amenities::create([
            'amenity_name' => 'Treehouse Spa and Wellness Center',
            'description' => 'Elevate your senses at our exclusive Treehouse Spa and Wellness Center, 
            perched amidst the lush canopy of the jungle. Experience rejuvenating treatments inspired by nature, 
            surrounded by the soothing sounds of rustling leaves and birdsong.',
            'price_per_use' => 1000.00,
            'image_path' => 'images/amenities/amenities_spa.webp',
        ]);
    }
}
