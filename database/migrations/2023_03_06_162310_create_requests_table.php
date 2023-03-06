<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_money', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('start_office_id');
            $table->unsignedBigInteger('request_office_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('collector_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->softDeletes();

            $table->index('user_id', 'request_money_user_idx');
            $table->foreign('user_id', 'request_money_user_fk')->on('users')->references('id');

            $table->index('start_office_id', 'request_money_start_office_idx');
            $table->foreign('start_office_id', 'request_money_start_office_fk')->on('offices')->references('id');

            $table->index('request_office_id', 'request_money_request_office_idx');
            $table->foreign('request_office_id', 'request_money_request_office_fk')->on('offices')->references('id');

            $table->index('currency_id', 'request_money_currency_idx');
            $table->foreign('currency_id', 'request_money_currency_fk')->on('currencies')->references('id');

            $table->index('collector_id', 'request_money_collector_idx');
            $table->foreign('collector_id', 'request_money_collector_fk')->on('collectors')->references('id');

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
