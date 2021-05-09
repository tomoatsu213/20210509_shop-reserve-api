<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('shop_id')->references('id')->on('shops'); // 外部キー参照
            $table->bigInteger('user_id')->references('id')->on('users'); // 外部キー参照
            $table->date('reservation_date');
            $table->dateTime('reservation_time');
            $table->string('reservation_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
