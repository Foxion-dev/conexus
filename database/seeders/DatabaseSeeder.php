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
use App\Models\RequestMoney;
use App\Models\RequestMoneyStatus;
use App\Models\Role;
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
        $this->createDefaultData();

        Client::factory(10)->create();
//        Office::factory(10)->create();
        Collector::factory(5)->create();
        Leftovers::factory(10)->create();
        Commission::factory(15)->create();

        User::create(['name' => 'Admin', 'email' => 'admin@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb'), 'role_id' => 1]);
        User::create(['name' => 'Operator', 'email' => 'oper@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb'), 'role_id' => 2]);
        User::create(['name' => 'Operator 2', 'email' => 'oper2@conexus.com', 'password' => bcrypt('HgZuM9XjBBE7xkb'), 'role_id' => 2]);

        OfficeDay::factory(15)->create();
        WorkDay::factory(30)->create();
        Deal::factory(10)->create();
        RequestMoney::factory(30)->create();

        // \App\Models\User::factory(10)->create();
    }

    public function createDefaultData()
    {

        $currencies = ['USD', 'KZT', 'USDT', 'GEL'];
        $sources = ['улица', 'inst', 'telegram', 'друг', 'таргет'];
        $dealTypes = ['Продажа', 'Покупка'];
        $requestStatuses = ['Отправлен', 'В процессе', 'Выполнен', 'Отклонён'];
        $encashmentTypes = ['Приход', 'Расход'];
        $offices = ['Батуми', 'Тбилиси', 'Кабулети', 'Стамбул', 'Киев'];
        $roles = ['admin', 'operator', 'develop'];

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
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['title' => $role],
                ['title' => $role]
            );
        }
    }
}
