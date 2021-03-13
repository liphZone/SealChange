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
            $table->integer('coin_enter');
            $table->integer('coin_out');
            $table->double('amount');
            $table->double('having_amount');
            $table->string('id_transaction');
            $table->string('devise_enter');
            $table->string('devise_out');
            $table->string('telephone')->nullable();
            $table->string('myaccount')->nullable();
            $table->string('account_receiver')->nullable();
            $table->integer('user');
            $table->boolean('etat')->default(0);
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
