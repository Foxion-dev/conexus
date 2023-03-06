<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    // подключаем "мягкое удаление"

    protected $table = 'clients'; // хорошая практика ставить явно имя таблицы
    protected $guarded = []; // разрешаем добавлять в бд записи(список запрещённых)

    public function searchableAs()
    {
        return 'clients_index';
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'deal_id', 'id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id', 'id');
    }
}
