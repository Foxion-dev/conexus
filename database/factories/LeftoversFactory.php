<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Leftovers;
use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeftoversFactory extends Factory
{
    protected $model = Leftovers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => Carbon::now()->subDays(random_int(1,10)),
            'GEL' => random_int(1,100000),
            'KZT' => random_int(0, 100000),
            'USDT' => random_int(0, 100000),
            'USD' => random_int(0, 100000),
        ];
    }
}
