<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 20,2)->nullable(); // количество
            $table->unsignedBigInteger('currency_id')->nullable(); // валюта
            $table->unsignedBigInteger('work_day_id')->nullable(); // рабочий день
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('work_day_id', 'expense_work_day_idx');
            $table->foreign('work_day_id', 'expense_work_day_fk')->on('work_days')->references('id');

            $table->index('currency_id', 'expense_receiving_currency_idx');
            $table->foreign('currency_id', 'expense_receiving_currency_fk')->on('currencies')->references('id');
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
        Schema::dropIfExists('expenses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
