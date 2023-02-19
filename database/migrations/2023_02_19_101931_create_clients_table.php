<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('person_photo');
            $table->string('person_documents');
            $table->text('comment');
            $table->unsignedBigInteger('source_id');
            $table->timestamps();

            $table->softDeletes(); // подключаем "мягкое удаление"

            $table->index('source_id', 'source_idx');
            $table->foreign('source_id', 'source_fk')->on('sources')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
