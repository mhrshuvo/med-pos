<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('contact_id');
            $table->string('purchase_no');
            $table->double('discount')->default(0);
            $table->boolean('discount_type')->comment('0 => fixed,1 => percentage');
            $table->double('discount_amount')->default(0);
            $table->double('vat')->default(0);
            $table->boolean('vat_type')->comment('0 => fixed,1 => percentage');
            $table->double('vat_amount')->default(0);
            $table->integer('total_quantity')->default(0);
            $table->double('total_amount')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
