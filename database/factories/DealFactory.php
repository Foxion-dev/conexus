<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory
{
    protected $model = Deal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'deal_type_id' => DealType::get()->random()->id,
            'client_id' => Client::get()->random()->id,
            'receiving_sum' => random_int(0, 100000),
            'return_sum' => random_int(0, 100000),
            'commission' => random_int(1,5),
            'receiving_currency_id' => Currency::get()->random()->id,
            'return_currency_id' => Currency::get()->random()->id,
        ];
    }
}
