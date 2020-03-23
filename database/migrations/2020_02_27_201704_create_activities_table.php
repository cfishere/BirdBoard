<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->nullableMorphs('subject');
            //$table->morphs('subject'); and $table->nullableMorphs('subject')
            //  ----- is identical to doing these 2 lines:
            //  $table->unsignedBigInteger('subject_id'); e.g., 6
            //  $table->string('subject_type'); e.g., 'App\Task'            
            $table->string('description');
            $table->text('changes')->nullable();
             $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('project_id')->references('id')
                ->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
