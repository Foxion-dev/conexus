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

    public function officeDay()
    {
        return $this->belongsTo(OfficeDay::class, 'office_day_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    public function deals()
    {
        return $this->hasMany(Deal::class, 'work_day_id', 'id'); // находит по связи "один"
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'work_day_id', 'id'); // находит по связи "один"
    }

    public function encashments()
    {
        return $this->hasMany(Encashment::class, 'work_day_id', 'id'); // находит по связи "один"
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
