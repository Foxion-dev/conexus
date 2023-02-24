<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->float('USD')->nullable();
            $table->float('USDT')->nullable();
            $table->float('KZT')->nullable();
            $table->float('GEL')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('office_id', 'leftovers_office_idx');
            $table->foreign('office_id', 'leftovers_office_fk')->on('offices')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leftovers');
    }
}
