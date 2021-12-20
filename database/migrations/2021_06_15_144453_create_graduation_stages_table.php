<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduation_stages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('previous_stage')->nullable();
            $table->string('next_stage_name')->nullable();
            $table->longText('progress_summary')->nullable();
            $table->dateTime('graduation_date')->nullable();
            $table->uuid('project_stage_id')->nullable();
            $table->uuid('stage_id')->nullable();

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
        Schema::dropIfExists('graduation_stages');
    }
}
