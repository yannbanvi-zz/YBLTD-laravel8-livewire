<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nom" => $this->faker->lastName,
            "noSerie" => $this->faker->swiftBicNumber,
            "imageUrl" => "images/imageplaceholder.png",
            "type_article_id" => rand(1,4),
            "estDisponible" => rand(0, 1)
        ];
    }
}
