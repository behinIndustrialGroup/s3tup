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
        Schema::create('industry_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('ceo_firstname');
            $table->string('ceo_lastname');
            $table->string('ceo_mobile', 32);
            $table->string('representative_fullname')->nullable();
            $table->string('representative_mobile', 32)->nullable();
            $table->string('province');
            $table->string('address', 500);
            $table->string('requested_capacity')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_registrations');
    }
};
