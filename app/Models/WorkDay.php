<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDay extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'work_days'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function scopeWhereDateBetween($query,$fieldName,$fromDate,$todate)
    {
        return $query->whereDate($fieldName,'>=',$fromDate)->whereDate($fieldName,'<=',$todate);
    }
//    public function scopeFirstOrCreateCustom()
//    {
////        return $query->whereDate($fieldName,'>=',$fromDate)->whereDate($fieldName,'<=',$todate);
//    }

    public function commissions()
    {
        return [
            'sale' =>   $this->belongsTo(Commission::class, 'work_day_commissions_sale', 'id'),
            'buy' =>   $this->belongsTo(Commission::class, 'work_day_commissions_buy', 'id')
        ];
    }

    public function leftovers()
    {
        return $this->belongsTo(Leftovers::class, 'work_day_leftovers', 'id'); // находит по связи "один"
    }

}
