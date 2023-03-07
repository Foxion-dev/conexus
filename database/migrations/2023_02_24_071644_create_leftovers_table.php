<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLeftoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leftovers', function (Blueprint $table) {
            $table->id();
            $table->float('USD',20,2)->nullable();
            $table->float('USDT',20,2)->nullable();
            $table->float('KZT',20,2)->nullable();
            $table->float('GEL',20,2)->nullable();
//            $table->unsignedBigInteger('office_day_id')->nullable();
            $table->timestamps();

            $table->softDeletes();

//            $table->index('office_day_id', 'leftovers_office_day_idx');
//            $table->foreign('office_day_id', 'leftovers_office_day_fk')->on('office_days')->references('id');

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
        Schema::dropIfExists('leftovers');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
