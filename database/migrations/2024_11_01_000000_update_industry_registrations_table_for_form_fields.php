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
        Schema::table('industry_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'ceo_firstname',
                'ceo_lastname',
                'ceo_mobile',
                'representative_fullname',
                'representative_mobile',
                'requested_capacity',
            ]);

            $table->string('economic_code', 100)->nullable()->after('company_name');
            $table->string('industry_type', 150)->after('industry_ministry_code');
            $table->string('contact_name', 150)->after('industry_type');
            $table->string('contact_position', 100)->after('contact_name');
            $table->string('mobile', 32)->after('contact_position');
            $table->string('email')->nullable()->after('mobile');
            $table->string('city', 150)->after('province');
            $table->string('voltage_level', 50)->after('address');
            $table->string('demand_kw', 100)->nullable()->after('voltage_level');
            $table->json('goals')->nullable()->after('demand_kw');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('industry_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'economic_code',
                'industry_type',
                'contact_name',
                'contact_position',
                'mobile',
                'email',
                'city',
                'voltage_level',
                'demand_kw',
                'goals',
            ]);

            $table->string('ceo_firstname')->nullable();
            $table->string('ceo_lastname')->nullable();
            $table->string('ceo_mobile', 32)->nullable();
            $table->string('representative_fullname')->nullable();
            $table->string('representative_mobile', 32)->nullable();
            $table->string('requested_capacity')->nullable();
        });
    }
};
