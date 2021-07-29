<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title', 250);
            $table->string('description')->nullable();
            $table->string('type', 50);
            $table->string('severity', 50);
            $table->datetime('dueDate');
            $table->string('status', 50);
            $table->foreignId('project_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('assignee_id');
            $table
                ->foreign('assignee_id')
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
        Schema::dropIfExists('issues');
    }
}
