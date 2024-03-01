<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {

        return [
            'title' => fake()->sentence,
            'description' => fake()->text(250),
            'full_txt' => fake()->text(256),
            'image' => fake()->imageUrl(600, 600),
            'publish_date' => fake()->dateTimeThisMonth(),
        ];
    }
}
