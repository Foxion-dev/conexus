<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Source;
use App\Models\User;
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
        $currencies = ['USD', 'KZT', 'USDT', 'GEL', 'RUB'];
        $sources = ['улица', 'inst', 'telegram', 'друг', 'таргет'];
        $dealTypes = ['Продажа', 'Покупка'];

//        Source::factory(5)->create();
//        DealType::factory(2)->create();
//        Currency::factory(3)->create();
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

        Client::factory(10)->create();
        Deal::factory(10)->create();
        User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);
        // \App\Models\User::factory(10)->create();
    }
}
