<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
            $table->unsignedBigInteger('work_day_id')->nullable();
            $table->smallInteger('blocked')->default(0);

            $table->index('work_day_id', 'user_work_day_idx');
            $table->foreign('work_day_id', 'user_work_day_fk')->on('work_days')->references('id');
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

//            $table->dropForeign('user_work_day_fk');
//            $table->dropIndex('user_work_day_idx');
//
//            $table->drop('role');
//            $table->drop('work_day_id');
//            $table->drop('blocked');
        });
    }
}
