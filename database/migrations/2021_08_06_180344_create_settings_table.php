<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_tile')->default('Pharmacy');
            $table->string('pharmacy_name')->default('Medicare Ltd');
            $table->string('email')->default('medicare@pharmacy.com');
            $table->string('phone')->default('01366142584');
            $table->string('address')->default('Mirpur Dhaka');
            $table->string('logo')->default('assets/backend/image/logo.png');
            $table->string('favicon')->default('assets/backend/image/favicon.png');
            $table->timestamps();
        });

        \App\Models\Setting::create([]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
