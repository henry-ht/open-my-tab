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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->enum('order_state', ['pending', 'active', 'complete', 'cancelled'])->default('pending');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedBigInteger('user_id');
            $table->string('reference', 50)->unique();
            $table->text('payment_method');
            $table->string('payu_order_id', 250)->unique()->nullable();
            $table->string('payment_status', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
