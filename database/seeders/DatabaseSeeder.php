<?php

namespace Database\Seeders;
use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* */
        \App\Models\User::factory()->create();

        $name = 'React'; $name_2 = 'Next.js'; $name_3 = 'Vue.js'; $name_4 = 'Laravel'; $name_5 = 'Angular';
        Tag::create(
            [
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name)
            ]
        );
        Tag::create([
                'name' => $name_2,
                'slug' => \Illuminate\Support\Str::slug($name_2)
            ]
        );
        Tag::create([
                'name' => $name_3,
                'slug' => \Illuminate\Support\Str::slug($name_3)
            ]
        );
        Tag::create([
                'name' => $name_4,
                'slug' => \Illuminate\Support\Str::slug($name_4)
           ]
        );
        Tag::create(
            [
                'name' => $name_5,
                'slug' => \Illuminate\Support\Str::slug($name_5)
            ]
        );

        // GIG/LISTING
        $title = 'React Junior Developer';
        $title_2 = 'React Mid-Level Developer';
        $title_3 = 'React Senior Developer';

        $this->faker = Faker::create();
        // $number = $this->faker->randomDigit();

        $datetime = $this->faker->dateTimeBetween(startDate: '-1 month', endDate: 'now');

        Listing::create([
            'user_id' => 1, # I theorithecally use this 10 random figures because i already have 10 users in the database with ids from 1-10
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title). '-' .rand(111, 9999),
            'company' => 'Crystal Digital',
            'country' => 'Nigeria',
            'is_highlighted' => (rand(1, 9) > 7),
            'state' => 'Lagos',
            'address' => $this->faker->address,
            'description' => 'A mid level junior react developer needed with a great experience',
            'min_amount' => '700k',
            'max_amount' => '1.2m',
            'created_at' => $datetime,
            'updated_at' => $datetime
        ]);

        Listing::create(
            [
                'user_id' => 1,
                'title' => $title_2,
                'slug' => \Illuminate\Support\Str::slug($title_2). '-' .rand(111, 9999),
                'company' => 'Crystal Digital',
                'country' => 'United States',
                'state' => 'New York',
                'address' => $this->faker->address,
                'description' => 'A mid-level react developer needed with a great experience',
                'min_amount' => '1.5m',
                'max_amount' => '2.6m'
            ]
        );

        Listing::create(
            [
                'user_id' => 1, # I theorithecally use this 10 random figures because i already have 10 users in the database with ids from 1-10
                'title' => $title_3,
                'slug' => \Illuminate\Support\Str::slug($title_3). '-' .rand(111, 9999),
                'company' => 'Crystal Digital',
                'country' => 'Canada',
                'is_highlighted' => (rand(1, 9) > 7),
                'state' => 'Ontario',
                'address' => $this->faker->address,
                'description' => 'A senior react developer needed with a great experience',
                'min_amount' => '2.4m',
                'max_amount' => '6m',
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]
        );
        /** */
        // $tags = Tag::factory(10)->create();

        // User::factory(20)->create()->each(function($user) use($tags) {
        //     Listing::factory(rand(1, 4))->create([
        //         'user_id' => $user->id
        //     ])->each(function($listing) use($tags) {
        //         $listing->tags()->attach($tags->random(2));
        //     });
        // });
    }
}
