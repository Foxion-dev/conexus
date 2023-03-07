<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->float('buy_KZT')->nullable();
            $table->float('buy_GEL')->nullable();
            $table->float('buy_RUB')->nullable();
            $table->float('sale_KZT')->nullable();
            $table->float('sale_GEL')->nullable();
            $table->float('sale_RUB')->nullable();
            $table->timestamps();

            $table->softDeletes();

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
        Schema::dropIfExists('exchange_rates');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
