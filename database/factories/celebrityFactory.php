<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Celebrity>
 */
class celebrityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // function imageUrl(
        //     int $width = 640,
        //     int $height = 480,
        //     ?string $category = null, /* used as text on the image */
        //     bool $randomize = true,
        //     ?string $word = null,
        //     bool $gray = false
        // ): string;

        return [
            'firstname' => $this->faker->firstname,
            'lastname' => $this->faker->lastname,
            'description' => $this->faker->text(300), // text with 300 words
            'image' => $this->faker->imageUrl(360, 360, 'animals', true, 'cats'),
            'created_at' => now()
        ];

        // command line => php artisan make:factory celebrityFactory --model=Celebrity (command to create factory)

        // generate dummy content in DB
        // command line => php artisan tinker (run to execute php code)
        // php code => Celebrity::factory()->count(10)->create(); (Creates 10 dummy content)
    }
}
