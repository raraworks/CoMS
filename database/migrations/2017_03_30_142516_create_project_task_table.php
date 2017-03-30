<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('project_tasks', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('project_id');
        $table->string('task_name');
        $table->text('content')->nullable();
        $table->date('due_date')->nullable();
        $table->time('due_time')->nullable();
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
      Schema::dropIfExists('project_tasks');
    }
}
