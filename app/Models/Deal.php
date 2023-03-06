<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory;
    use SoftDeletes;

    // подключаем "мягкое удаление"

    protected $table = 'deals'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id'); // находит по связи "один"
    }

    public function type()
    {
        return $this->belongsTo(DealType::class, 'deal_type_id', 'id'); // находит по связи "один"
    }

    public function receivingCurrency()
    {
        return $this->belongsTo(Currency::class, 'receiving_currency_id', 'id'); // находит по связи "один"
    }

    public function returnCurrency()
    {
        return $this->belongsTo(Currency::class, 'return_currency_id', 'id'); // находит по связи "один"
    }

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class, 'work_day_id', 'id'); // находит по связи "один"
    }
}

