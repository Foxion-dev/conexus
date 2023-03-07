<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWorkDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_days', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start')->nullable();
            $table->timestamp('finish')->nullable();
//            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('office_day_id')->nullable();
//            $table->unsignedBigInteger('leftovers_id')->nullable();
//            $table->unsignedBigInteger('commissions_id_buy')->nullable();
//            $table->unsignedBigInteger('commissions_id_sale')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('user_id', 'work_day_user_idx');
            $table->foreign('user_id', 'work_day_user_fk')->on('users')->references('id');

            $table->index('office_day_id', 'work_day_office_day_idx');
            $table->foreign('office_day_id', 'work_day_office_day_fk')->on('office_days')->references('id');

//            $table->index('office_id', 'work_day_office_idx');
//            $table->foreign('office_id', 'work_day_office_fk')->on('offices')->references('id');

//            $table->index('leftovers_id', 'work_day_leftovers_idx');
//            $table->foreign('leftovers_id', 'work_day_leftovers_fk')->on('leftovers')->references('id');
//
//            $table->index('commissions_id_buy', 'work_day_commissions_buy_idx');
//            $table->foreign('commissions_id_buy', 'work_day_commissions_buy_fk')->on('commissions')->references('id');
//
//            $table->index('commissions_id_sale', 'work_day_commissions_sale_idx');
//            $table->foreign('commissions_id_sale', 'work_day_commissions_sale_fk')->on('commissions')->references('id');
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
        Schema::dropIfExists('work_days');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
