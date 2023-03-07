<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Collector;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\OfficeDay;
use App\Models\RequestMoney;
use App\Models\RequestMoneyStatus;
use App\Models\User;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestMoneyFactory extends Factory
{
    protected $model = RequestMoney::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_day_id' => WorkDay::get()->random()->id,
            'start_office_id' => Office::get()->random()->id,
            'request_office_id' => Office::get()->random()->id,
            'currency_id' => Currency::get()->random()->id,
            'collector_id' => Collector::get()->random()->id,
            'status_id' => RequestMoneyStatus::get()->random()->id,
            'amount' => random_int(100,100000),
        ];
    }
}
