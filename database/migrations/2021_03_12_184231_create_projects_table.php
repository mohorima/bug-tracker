<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title', 250)->unique();
            $table->string('description')->nullable();
            $table->datetime('startDate');
            $table->datetime('endDate');
            $table->string('billingType', 50)->nullable();
            $table->decimal('cost', 14, 2)->nullable();
            $table->mediumInteger('estHours')->nullable();
            $table->string('tag', 50)->nullable();
            $table->string('status', 50);
            $table->foreignId('client_id')->constrained();
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');

        Schema::dropIfExists('project_user');
    }
}
