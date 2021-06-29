<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('slug', 100)->unique();
            $table->string('description', 255)->nullable();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table
                ->foreignId('role_id')
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('permission_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
    }
}
