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
            

            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('status')->default('pending'); 
            $table->timestamps();
            $table->integer('total_price')->nullable(); // Total price of the order
            $table->string('address')->nullable(); // Shipping address
            //add phone number
            $table->string('phone_number')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
