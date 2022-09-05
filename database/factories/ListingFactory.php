<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*
            The reason for hardcoding below format is that i want the description save in the database as html
            later on, when someone creates a post, they'll be using markdown which will end up generating html
        */
        
        $desc = '';

        for($i=0; $i < 5; $i++) {
            $desc .= '<p class="mb-4">' . $this->faker->sentences(rand(5, 10), asText: true) . '</p>';
        }

    }
}
