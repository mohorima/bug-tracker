<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('company', 250)->unique();
            $table->string('owner', 100)->nullable();
            $table->string('address', 250);
            $table->string('country', 50);
            $table->string('contactPerson', 100)->nullable();
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
