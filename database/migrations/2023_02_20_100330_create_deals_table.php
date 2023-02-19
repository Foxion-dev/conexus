<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_type_id')->nullable(); // тип сделки
            $table->unsignedBigInteger('client_id')->nullable(); // id клиента
            $table->unsignedBigInteger('receiving_sum')->nullable(); // сумма получения
            $table->unsignedBigInteger('return_sum')->nullable(); // сумма отдачи
            $table->unsignedFloat('commission')->nullable(); // комиссия
            $table->unsignedBigInteger('receiving_currency_id')->nullable(); // валюта получения
            $table->unsignedBigInteger('return_currency_id')->nullable(); // валюта отдачи
            $table->timestamps();

            $table->softDeletes(); // подключаем "мягкое удаление"

            $table->index('deal_type_id', 'deal_type_idx');
            $table->foreign('deal_type_id', 'deal_type_fk')->on('deal_types')->references('id');

            $table->index('client_id', 'deal_client_idx');
            $table->foreign('client_id', 'deal_client_fk')->on('clients')->references('id');

            $table->index('receiving_currency_id', 'deal_receiving_currency_idx');
            $table->foreign('receiving_currency_id', 'deal_receiving_currency_fk')->on('currencies')->references('id');

            $table->index('return_currency_id', 'deal_return_currency_idx');
            $table->foreign('return_currency_id', 'deal_return_currency_fk')->on('currencies')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
