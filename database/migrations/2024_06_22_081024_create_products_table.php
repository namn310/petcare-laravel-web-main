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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('idCat');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('idPro');
            $table->string('namePro');
            $table->string('description', 5000)->nullable();
            $table->integer('count');
            // $table->string('image');
            $table->integer('hot')->nullable();
            $table->integer('cost');
            $table->integer('discount')->nullable();
            $table->timestamps();
            //foreign key categories
            $table->unsignedInteger('idCat');
            $table->foreign('idCat')->references('idCat')->on('categories')->onDelete('cascade');
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');

        Schema::dropIfExists('customer');
    }
};
