<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\OfficeDay;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficeDayFactory extends Factory
{
    protected $model = OfficeDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => Carbon::now()->subDays(random_int(1,10)),
            'office_id' => Office::get()->random()->id,
            'leftovers_id' => Leftovers::get()->random()->id,
            'commissions_id_buy' => Commission::get()->random()->id,
            'commissions_id_sale' => Commission::get()->random()->id,
        ];
    }
}
