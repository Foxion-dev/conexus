<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->float('from_0')->nullable();
            $table->float('from_100')->nullable();
            $table->float('from_1000')->nullable();
            $table->float('from_10000')->nullable();
            $table->float('from_50000')->nullable();
            $table->float('from_100000')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->timestamps();

            $table->softDeletes(); // подключаем "мягкое удаление"

            $table->index('office_id', 'commissions_office_idx');
            $table->foreign('office_id', 'commissions_office_fk')->on('offices')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
