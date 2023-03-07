<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestMoney extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'request_money'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function status()
    {
        return $this->belongsTo(RequestMoneyStatus::class, 'status_id', 'id');
    }

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class, 'work_day_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function startOffice()
    {
        return $this->belongsTo(Office::class, 'start_office_id', 'id');
    }

    public function requestOffice()
    {
        return $this->belongsTo(Office::class, 'request_office_id', 'id');
    }

    public function collector()
    {
        return $this->belongsTo(Collector::class, 'collector_id', 'id');
    }
}
