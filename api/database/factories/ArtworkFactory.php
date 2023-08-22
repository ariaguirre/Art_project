<?php

namespace Database\Factories;

use App\Models\Artwork;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtworkFactory extends Factory
{
    protected $model = Artwork::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'artistDisplayName' => $this->faker->name,
            'primaryImage' => $this->faker->imageUrl,
            'department' => $this->faker->word,
            'artistDisplayBio' => $this->faker->paragraph,
            'artistNationality' => $this->faker->country,
            'artistBeginDate' => $this->faker->year,
            'artistEndDate' => $this->faker->year,
            'artistWikidata_URL' => $this->faker->url,
            'objectBeginDate' => $this->faker->year,
            'objectEndDate' => $this->faker->year,
            'dimensions' => $this->faker->sentence,
            'objectURL' => $this->faker->url,
        ];
    }
}
