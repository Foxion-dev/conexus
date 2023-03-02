<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('leftovers_id')->nullable();
            $table->unsignedBigInteger('commissions_id_buy')->nullable();
            $table->unsignedBigInteger('commissions_id_sale')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('user_id', 'work_day_user_idx');
            $table->foreign('user_id', 'work_day_user_fk')->on('users')->references('id');

            $table->index('office_id', 'work_day_office_idx');
            $table->foreign('office_id', 'work_day_office_fk')->on('offices')->references('id');

            $table->index('leftovers_id', 'work_day_leftovers_idx');
            $table->foreign('leftovers_id', 'work_day_leftovers_fk')->on('leftovers')->references('id');

            $table->index('commissions_id_buy', 'work_day_commissions_buy_idx');
            $table->foreign('commissions_id_buy', 'work_day_commissions_buy_fk')->on('commissions')->references('id');

            $table->index('commissions_id_sale', 'work_day_commissions_sale_idx');
            $table->foreign('commissions_id_sale', 'work_day_commissions_sale_fk')->on('commissions')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign('user_work_day_fk');
            $table->dropIndex('user_work_day_idx');
        });
        Schema::dropIfExists('work_days');
    }
}
