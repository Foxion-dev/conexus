<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Leftovers;
use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionFactory extends Factory
{
    protected $model = Commission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['sale', 'buy'];
        return [
            'created_at' => Carbon::now()->subDays(random_int(1,10)),
            'from_0' => random_int(1,3),
            'from_100' => random_int(1, 3),
            'from_1000' => random_int(1, 3),
            'from_10000' => random_int(1, 3),
            'from_50000' => random_int(1, 3),
            'from_100000' => random_int(1, 3),
            'office_id' => Office::get()->random()->id,
            'type' => $types[random_int(0, 1)],
        ];
    }
}
