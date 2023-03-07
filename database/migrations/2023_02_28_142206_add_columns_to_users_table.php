<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('role_id')->default(2);
            $table->unsignedBigInteger('work_day_id')->nullable();
            $table->smallInteger('blocked')->default(0);

            $table->index('role_id', 'user_role_idx');
            $table->foreign('role_id', 'user_role_fk')->on('roles')->references('id');

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
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $table->dropForeign('user_work_day_fk');
            $table->dropIndex('user_work_day_idx');
            $table->dropColumn('work_day_id');
            $table->dropColumn('blocked');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }
}
