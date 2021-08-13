<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('subject', 250);
            $table->string('description')->nullable();
            $table->string('priority', 50);
            $table->string('status', 50);
            $table->datetime('startDate');
            $table->datetime('endDate');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->unsignedBigInteger('collaborator_id');
            $table
                ->foreign('collaborator_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
