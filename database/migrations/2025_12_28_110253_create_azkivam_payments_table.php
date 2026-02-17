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
        Schema::create('azkivam_payments', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('payment_uri');
            $table->string('order_id');
            $table->unsignedBigInteger('amount');
            $table->string('status')->default('pending');
            $table->string('callback_url');
            $table->string('tracking_code')->nullable();
            $table->json('meta')->nullable();
            $table->json('provider_payload')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('azkivam_payments');
    }
};
