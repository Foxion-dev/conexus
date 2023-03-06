<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncashmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encashments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable(); // на счёт/ с счёта
            $table->float('amount',20,2)->nullable(); // количество
            $table->unsignedBigInteger('work_day_id')->nullable(); // рабочий день
            $table->unsignedBigInteger('collector_id')->nullable(); // инкассатор
            $table->unsignedBigInteger('currency_id')->nullable(); // валюта
            $table->timestamps();

            $table->softDeletes();

            $table->index('work_day_id', 'encashment_work_day_idx');
            $table->foreign('work_day_id', 'encashment_work_day_fk')->on('work_days')->references('id');

            $table->index('type_id', 'encashment_type_idx');
            $table->foreign('type_id', 'encashment_type_fk')->on('encashment_types')->references('id');

            $table->index('currency_id', 'encashment_currency_idx');
            $table->foreign('currency_id', 'encashment_currency_fk')->on('currencies')->references('id');

            $table->index('collector_id', 'encashment_collector_idx');
            $table->foreign('collector_id', 'encashment_collector_fk')->on('collectors')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encashments');
    }
}
