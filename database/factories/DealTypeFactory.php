<?php

namespace Database\Factories;

use App\Models\DealType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealTypeFactory extends Factory
{
    protected $model = DealType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dealTypes = [
            'sale',
            'buy'
        ];

        return [
            'title' => next($dealTypes)
        ];
    }
}
