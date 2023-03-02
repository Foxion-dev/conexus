<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDay extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $currentDay;
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

    public function commissionsBuy()
    {
        return $this->belongsTo(Commission::class, 'commissions_id_buy', 'id');
    }

    public function commissionsSale()
    {
        return $this->belongsTo(Commission::class, 'commissions_id_sale', 'id');
    }

    public function commissions(){
        return [
            'sale' => self::commissionsSale(),
            'buy' => self::commissionsBuy(),
        ];
    }

    public function leftovers()
    {
        return $this->belongsTo(Leftovers::class, 'leftovers_id', 'id'); // находит по связи "один"
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'work_day_id', 'id'); // находит по связи "один"
    }

//    public function setCurrent($day)
//    {
//        self::$currentDay = $day;
//    }
//
//    public function getCurrent()
//    {
//        return self::$currentDay;
//    }

}
