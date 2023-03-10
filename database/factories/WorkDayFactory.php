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
use App\Models\User;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkDayFactory extends Factory
{
    protected $model = WorkDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => Carbon::now()->subDays(random_int(1,20)),
            'office_day_id' => OfficeDay::get()->random()->id,
            'user_id' => User::get()->random()->id,
        ];
    }
}
