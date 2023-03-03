<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncashmentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    // подключаем "мягкое удаление"

    protected $table = 'encashment_types'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

//    public function encashments()
//    {
//        return $this->hasMany(Deal::class, 'encashments_id', 'id');
//    }
}
