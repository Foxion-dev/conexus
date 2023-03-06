<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expenses'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id'); // находит по связи "один"
    }

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class, 'work_day_id', 'id'); // находит по связи "один"
    }

}
