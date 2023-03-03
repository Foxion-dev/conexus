<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Collector;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\EncashmentType;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\Source;
use App\Models\User;
use App\Models\WorkDay;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $currencies = ['USD', 'KZT', 'USDT', 'GEL'];
        $sources = ['улица', 'inst', 'telegram', 'друг', 'таргет'];
        $dealTypes = ['Продажа', 'Покупка'];
        $encashmentTypes = ['Приход', 'Расход'];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(
                ['title' => $currency],
                ['title' => $currency]
            );
        }
        foreach ($sources as $source) {
            Source::firstOrCreate(
                ['title' => $source],
                ['title' => $source]
            );
        }
        foreach ($dealTypes as $dealType) {
            DealType::firstOrCreate(
                ['title' => $dealType],
                ['title' => $dealType]
            );
        }
        foreach ($encashmentTypes as $encashmentType) {
            EncashmentType::firstOrCreate(
                ['title' => $encashmentType],
                ['title' => $encashmentType]
            );
        }

        Client::factory(10)->create();
        Deal::factory(10)->create();
        Office::factory(5)->create();
        Collector::factory(5)->create();
        Leftovers::factory(1)->create();
        Commission::factory(15)->create();

        User::create(['name' => 'Admin', 'email' => 'admin@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb')]);
        WorkDay::factory(1)->create();

        // \App\Models\User::factory(10)->create();
    }
}
