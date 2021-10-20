<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_id');
            $table->string('tanggal_histori');
            $table->string('saldo_histori');
            $table->integer('sisa_bayar');
            $table->string('keterangan_histori');
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
        Schema::dropIfExists('history_credits');
    }
}
