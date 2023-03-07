<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRequestMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_money', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_day_id');
            $table->unsignedBigInteger('start_office_id');
            $table->unsignedBigInteger('request_office_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('collector_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->softDeletes();

            $table->index('work_day_id', 'request_money_work_day_idx');
            $table->foreign('work_day_id', 'request_money_work_day_fk')->on('work_days')->references('id');

            $table->index('start_office_id', 'request_money_start_office_idx');
            $table->foreign('start_office_id', 'request_money_start_office_fk')->on('offices')->references('id');

            $table->index('request_office_id', 'request_money_request_office_idx');
            $table->foreign('request_office_id', 'request_money_request_office_fk')->on('offices')->references('id');

            $table->index('currency_id', 'request_money_currency_idx');
            $table->foreign('currency_id', 'request_money_currency_fk')->on('currencies')->references('id');

            $table->index('collector_id', 'request_money_collector_idx');
            $table->foreign('collector_id', 'request_money_collector_fk')->on('collectors')->references('id')->onDelete('cascade');

            $table->index('status_id', 'request_money_status_idx');
            $table->foreign('status_id', 'request_money_status_fk')->on('request_money_statuses')->references('id');

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
        Schema::dropIfExists('requests');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
