<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('tx_reference_flooz');
            $table->integer('coin_enter');
            $table->integer('coin_out');
            $table->double('amount');
            $table->string('payement_method')->nullable();
            $table->string('payement_reference')->nullable();
            $table->string('telephone')->nullable();
            $table->string('sender')->nullable();
            $table->string('receiver')->nullable();
            $table->integer('user');
            $table->boolean('etat')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
