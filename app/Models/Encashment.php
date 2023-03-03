<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encashment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'encashments'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function collector()
    {
        return $this->belongsTo(Collector::class, 'collector_id', 'id'); // находит по связи "один"
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id'); // находит по связи "один"
    }
    public function type()
    {
        return $this->belongsTo(EncashmentType::class, 'type_id', 'id'); // находит по связи "один"
    }
}
