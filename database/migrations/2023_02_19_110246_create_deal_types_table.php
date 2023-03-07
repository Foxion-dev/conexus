<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDealTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->timestamps();

            $table->softDeletes(); // подключаем "мягкое удаление"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('deal_types');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
