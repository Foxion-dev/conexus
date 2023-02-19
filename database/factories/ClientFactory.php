<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'contact' => $this->faker->text('5'),
            'person_photo' => $this->faker->imageUrl,
            'person_documents' => $this->faker->imageUrl,
            'comment' => $this->faker->text(30),
            'source_id' => Source::get()->random()->id,
        ];
    }
}
