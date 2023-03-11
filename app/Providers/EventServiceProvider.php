<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Commission;
use App\Models\Deal;
use App\Models\Encashment;
use App\Models\Expense;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\OfficeDay;
use App\Models\RequestMoney;
use App\Models\Source;
use App\Models\User;
use App\Models\WorkDay;
use App\Observers\ClientObserver;
use App\Observers\CommissionObserver;
use App\Observers\DealObserver;
use App\Observers\EncashmentObserver;
use App\Observers\ExpenseObserver;
use App\Observers\LeftoversObserver;
use App\Observers\OfficeDayObserver;
use App\Observers\OfficeObserver;
use App\Observers\RequestMoneyObserver;
use App\Observers\SourceObserver;
use App\Observers\UserObserver;
use App\Observers\WorkDayObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Source::observe(SourceObserver::class);
        Client::observe(ClientObserver::class);
        Commission::observe(CommissionObserver::class);
        Deal::observe(DealObserver::class);
        Encashment::observe(EncashmentObserver::class);
        Expense::observe(ExpenseObserver::class);
        Leftovers::observe(LeftoversObserver::class);
        Office::observe(OfficeObserver::class);
        WorkDay::observe(WorkDayObserver::class);
        RequestMoney::observe(RequestMoneyObserver::class);
        OfficeDay::observe(OfficeDayObserver::class);
        User::observe(UserObserver::class);
    }
}
