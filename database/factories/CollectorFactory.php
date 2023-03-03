<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Collector;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectorFactory extends Factory
{

    protected $model = Collector::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
