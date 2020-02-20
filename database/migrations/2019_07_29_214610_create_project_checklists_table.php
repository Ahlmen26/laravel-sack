<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_checklists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('survey_type')->unsigned();
            $table->integer('survey_phase')->unsigned();
            $table->integer('checklist_type')->unsigned();
            $table->integer('category')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('checklist_id')->unsigned();
            $table->integer('jira_temp_id')->unsigned();
            $table->integer('item_status')->unsigned();
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
        Schema::dropIfExists('project_checklists');
    }
}
