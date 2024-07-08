<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(0);
            $table->string('address');
            $table->string('note')->nullable();
            $table->string('thanhtoan');
            $table->timestamps();
            $table->unsignedInteger('idCus');
            $table->foreign('idCus')->references('id')->on('customer')->onDelete('cascade');
        });
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->timestamps();
            $table->integer('idPro');
            $table->string('price');
            $table->unsignedInteger('idOrder');
            $table->foreign('idOrder')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('orders');
         Schema::dropIfExists('order_detail');
    }
};
