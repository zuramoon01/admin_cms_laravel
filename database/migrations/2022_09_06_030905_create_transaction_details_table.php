<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactions_id');
            $table->foreignId('products_id');
            $table->unsignedInteger('qty');
            $table->decimal('price_satuan', $precision = 18);
            $table->decimal('price_total', $precision = 18);
            $table->decimal('price_purchase_satuan', $precision = 18);
            $table->decimal('price_purchase_total', $precision = 18);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};
