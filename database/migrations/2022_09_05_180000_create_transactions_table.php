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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('store_id');
            $table->decimal('value', 10, 2);
            $table->string('card_number', 12);
            $table->enum('type', [
                'Débito',
                'Boleto',
                'Financiamento',
                'Crédito',
                'Recebimento Empréstimo',
                'Vendas',
                'Recebimento TED',
                'Recebimento DOC',
                'Aluguel'
            ]);
            $table->date('date');
            $table->time('time');

            $table->foreign('user_id')
                ->on('users')
                ->references('id');

            $table->foreign('store_id')
                ->on('stores')
                ->references('id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
