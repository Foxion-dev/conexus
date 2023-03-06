<?php

namespace Database\Seeders;

use App\Http\Controllers\RequestMoneyController;
use App\Models\Client;
use App\Models\Collector;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\EncashmentType;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\OfficeDay;
use App\Models\RequestMoneyStatus;
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
        $requestStatuses = ['Запрос отправлен', 'В процессе', 'Выполнен', 'Отклонён'];
        $encashmentTypes = ['Приход', 'Расход'];
        $offices = ['Батуми', 'Тбилиси', 'Кабулети', 'Стамбул', 'Киев'];

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

        foreach ($offices as $office) {
            Office::firstOrCreate(
                ['name' => $office],
                ['name' => $office]
            );
        }
        foreach ($requestStatuses as $status) {
            RequestMoneyStatus::firstOrCreate(
                ['title' => $status],
                ['title' => $status]
            );
        }

        Client::factory(10)->create();
//        Office::factory(10)->create();
        Collector::factory(5)->create();
        Leftovers::factory(10)->create();
        Commission::factory(15)->create();

        User::create(['name' => 'Admin', 'email' => 'admin@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb')]);
        User::create(['name' => 'Operator', 'email' => 'oper@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb')]);
        User::create(['name' => 'Operator 2', 'email' => 'oper2@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb')]);

        OfficeDay::factory(5)->create();
        WorkDay::factory(10)->create();
        Deal::factory(10)->create();

        // \App\Models\User::factory(10)->create();
    }
}
