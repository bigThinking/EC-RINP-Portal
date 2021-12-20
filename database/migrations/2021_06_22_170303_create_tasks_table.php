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
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('isClosed')->default(false);
            $table->boolean('isDone')->default(false);
            $table->dateTime('last_updated_date')->nullable();
            $table->uuid('user_id')->nullable();
            $table->longText('closing_report')->nullable();
            $table->dateTime('date_closed')->nullable();
            $table->uuid('project_stage_id')->nullable();
            $table->uuid('project_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
