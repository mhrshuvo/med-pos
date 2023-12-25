<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("contact_id")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->unique();
            $table->string("alternate_phone")->nullable();
            $table->string("image")->nullable();
            $table->string("address")->nullable();
            $table->boolean("status")->default(1);
            $table->boolean("contact_type");
            $table->text("note")->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
